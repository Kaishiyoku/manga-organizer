<?php

namespace App\Http\Controllers;

use App\Models\GenreMalItem;
use App\Models\MalItem;
use App\Models\Manga;
use App\Models\Special;
use App\Models\Volume;
use App\ViewModels\LatestEntry;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laminas\Text\Table\Column;
use Laminas\Text\Table\Decorator\Ascii;
use Laminas\Text\Table\Row;
use Laminas\Text\Table\Table;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $mangas = Manga::withVolumesAndSpecials()->get();

        return view('manga.index', [
            'mangas' => $mangas,
        ]);
    }

    public function indexPlain()
    {
        $mangas = Manga::withVolumesAndSpecials()->get();

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

        $content = generateAsciiHeading(config('app.name')) . "\n\n" . implode("\n", $mangas->map($mangaMapper)->toArray());

        return response($content)->header('Content-Type', 'text/plain');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function manage()
    {
        $mangas = Manga::orderBy('name')->get();

        return view('manga.manage', [
            'mangas' => $mangas,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function statistics()
    {
        $mangas = Manga::withVolumesAndSpecials()->get();
        $volumes = Volume::with('manga')->orderByDesc('created_at');
        $specials = Special::with('manga')->orderByDesc('created_at');
        $topFiveGenres = GenreMalItem::query()
            ->select(['genre_id', 'genres.name', DB::raw('count(*) as total')])
            ->join('genres', 'genre_mal_item.genre_id', '=', 'genres.id')
            ->groupBy(['genre_id', 'genres.name'])
            ->orderByDesc('total')
            ->orderBy('genres.name')
            ->take(5)
            ->get();

        $latestVolumesAndSpecials = $volumes
            ->take(5)
            ->get()
            ->map(function ($volume) {
                return new LatestEntry($volume->created_at, $volume->manga->name . ' - ' . $volume->no);
            })
            ->merge(
                $specials
                    ->take(5)
                    ->get()
                    ->map(function ($special) {
                        return new LatestEntry($special->created_at, $special->manga->name . ' - ' . $special->name);
                    }))
            ->sortByDesc('created_at')->take(5);

        return view('manga.statistics', [
            'mangas' => $mangas,
            'volumes' => $volumes,
            'specials' => $specials,
            'latestVolumesAndSpecials' => $latestVolumesAndSpecials,
            'topFiveGenres' => $topFiveGenres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $manga = new Manga();

        return view('manga.create', [
            'manga' => $manga,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());

        $this->createMalItemIfNecessary($request);

        $manga = new Manga($request->all());
        $manga->save();

        flash(__('Manga added.'))->success();

        return redirect()->route('mangas.edit', $manga);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Manga $manga
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Manga $manga)
    {
        $newVolume = new Volume();
        $newSpecial = new Special();

        return view('manga.edit', [
            'manga' => $manga,
            'newVolume' => $newVolume,
            'newSpecial' => $newSpecial,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Manga $manga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Manga $manga)
    {
        $request->validate($this->rules($manga));

        $this->createMalItemIfNecessary($request);

        $manga->fill($request->all());
        $manga->is_completed = $request->get('is_completed', false);
        $manga->save();

        flash(__('Manga saved.'))->success();

        return redirect()->route('mangas.manage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Manga $manga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Manga $manga)
    {
        handleIntegrityConstraintViolation(__('Manga still has volumes. Delete them first.'), function () use ($manga) {
            $manga->delete();

            flash(__('Manga deleted.'))->success();
        });

        return redirect()->route('mangas.manage');
    }

    /**
     * @param Manga|null $manga
     * @return array
     */
    private function rules(Manga $manga = null)
    {
        return [
            'name' => [
                'required',
                Rule::unique('mangas', 'name')->when($manga, function ($query) use ($manga) {
                    $query->ignore($manga->id);
                }),
            ],
            'is_completed' => 'boolean',
            'mal_id' => 'integer|nullable',
        ];
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
