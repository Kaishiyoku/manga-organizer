<?php

namespace App\Http\Controllers;

use App\Models\MalItem;
use App\Models\Manga;
use App\Models\Recommendation;
use App\Models\Special;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laminas\Text\Table\Column;
use Laminas\Text\Table\Decorator\Ascii;
use Laminas\Text\Table\Row;
use Laminas\Text\Table\Table;

class MangaController extends Controller
{
    /**
     * @var string
     */
    private $redirectRoute = 'mangas.manage';

    /**
     * @var array
     */
    private $validationRules = [
        'name' => ['required'],
        'is_completed' => 'boolean',
        'mal_id' => 'integer|nullable',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mangas = $this->mangas()->get();

        return getViewByRequestType('manga.index', compact('mangas'));
    }

    public function indexPlain()
    {
        $mangas = $this->mangas()->get();

        $mangaMapper = function (Manga $manga) {
            $volumes = $manga->volumes;
            $specials = $manga->specials;

            $table = new Table();
            $table->setDecorator(Ascii::class);
            $table->setPadding(1);
            $table->setColumnWidths([16, 30]);
            $table->setAutoSeparate(Table::AUTO_SEPARATE_HEADER);

            $row = new Row();
            $row->appendColumn(new Column($manga->name, null, 2));
            $table->appendRow($row);

            $row = new Row();
            $row->appendColumn(new Column(__('manga.index.mal_score') . ':'));
            $row->appendColumn(new Column(($manga->malItem && $manga->malItem->score ? formatNumber($manga->malItem->score, 2) : 'n/a')));
            $table->appendRow($row);

            $row = new Row();
            $row->appendColumn(new Column(__('validation.attributes.is_completed') . ':'));
            $row->appendColumn(new Column(formatBool($manga->is_completed)));
            $table->appendRow($row);

            if ($volumes->isNotEmpty()) {
                $row = new Row();
                $row->appendColumn(new Column(trans_choice('manga.volumes', $volumes) . ':'));
                $row->appendColumn(new Column((string)intRangeToStr($volumes->pluck('no'))));
                $table->appendRow($row);
            }

            if ($specials->isNotEmpty()) {
                $row = new Row();
                $row->appendColumn(new Column(trans_choice('manga.specials', $specials) . ':'));
                $row->appendColumn(new Column($specials->implode('name', ', ')));
                $table->appendRow($row);
            }

            return $table->render();
        };

        $content = generateAsciiHeading(env('APP_NAME_LONG')) . "\n\n" . implode("\n", $mangas->map($mangaMapper)->toArray());

        return response($content)->header('Content-Type', 'text/plain');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $mangas = Manga::orderBy('name')->get();
        $recommendations = Recommendation::orderBy('created_at', 'desc')->get();

        return view('manga.manage', compact('mangas', 'recommendations'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statistics()
    {
        $mangas = $this->mangas()->get();
        $volumes = Volume::orderBy('created_at', 'desc');
        $specials = Special::orderBy('created_at', 'desc');

        $latestVolumesAndSpecials = $volumes->take(5)->get()->map(function ($volume) {
            return [
                'created_at' => $volume->created_at,
                'name' => $volume->manga->name . ' - ' . $volume->no
            ];
        })->merge($specials->take(5)->get()->map(function ($special) {
            return [
                'created_at' => $special->created_at,
                'name' => $special->manga->name . ' - ' . $special->name
            ];
        }))->sortByDesc('created_at')->take(5);

        return getViewByRequestType('manga.statistics', compact('mangas', 'volumes', 'specials', 'latestVolumesAndSpecials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manga = new Manga();

        return view('manga.create', compact('manga'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRulesWithNameUniqueness());

        $this->createMalItemIfNecessary($request);

        $manga = new Manga($request->all());
        $manga->save();

        flash(__('manga.create.success'))->success();

        return redirect()->route('mangas.edit', $manga);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Manga $manga
     * @return \Illuminate\Http\Response
     */
    public function edit(Manga $manga)
    {
        $newVolume = new Volume();
        $newSpecial = new Special();

        return view('manga.edit', compact('manga', 'newVolume', 'newSpecial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Manga $manga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manga $manga)
    {
        $request->validate($this->getValidationRulesWithNameUniqueness($manga));

        $this->createMalItemIfNecessary($request);

        $manga->fill($request->all());
        $manga->is_completed = $request->get('is_completed', false);
        $manga->save();

        flash(__('manga.edit.success'))->success();

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Manga $manga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manga $manga)
    {
        handleIntegrityConstraintViolation(__('manga.destroy.still_has_volumes'), function () use ($manga) {
            $manga->delete();

            flash(__('manga.destroy.success'))->success();
        });

        return redirect()->route($this->redirectRoute);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'query' => ['required', 'min:3'],
        ]);

        $query = Str::lower($data['query']);

        $mangaSearchResults = Cache::remember('manga-search-' . sha1($query), env('MANGA_SEARCH_CACHE_TTL_SECONDS', 60 * 60), function () use ($query) {
            $mangaSearchResults = collect(Arr::get(Http::get(env('MANGA_SEARCH_API_BASE_URL') . '/search/manga', [
                'q' => $query,
            ])->json(), 'results'));

            return $mangaSearchResults
                ->map(function ($mangaSearchResult) {
                    return [
                        'malId' => Arr::get($mangaSearchResult, 'mal_id'),
                        'title' => Arr::get($mangaSearchResult, 'title'),
                        'synopsis' => Arr::get($mangaSearchResult, 'synopsis'),
                        'imageUrl' => Arr::get($mangaSearchResult, 'image_url'),
                    ];
                });
        });

        return response()->json($mangaSearchResults);
    }

    private function mangas()
    {
        return Manga::with('volumes')->with('specials')->has('volumes')->orHas('specials')->orderBy('name');
    }

    private function getValidationRulesWithNameUniqueness(Manga $manga = null)
    {
        $nameUniquessRule = Rule::unique('mangas', 'name');

        if ($manga != null) {
            $nameUniquessRule = $nameUniquessRule->ignore($manga->id);
        }

        $validationRules = $this->validationRules;
        $validationRules['name'][] = $nameUniquessRule;

        return $validationRules;
    }

    /**
     * @param $request
     */
    private function createMalItemIfNecessary($request)
    {
        $malId = $request->get('mal_id', null);
        $malItem = MalItem::find($malId);

        if (!empty($malId) && empty($malItem)) {
            fetchAndSaveMalItemFor($malId);
        }
    }
}
