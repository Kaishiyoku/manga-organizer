<?php

namespace App\Http\Controllers;

use App\Models\MalItem;
use App\Models\Manga;
use App\Models\Recommendation;
use App\Models\Special;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rule;
use MathieuViossat\Util\ArrayToTextTable;

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

        return view('manga.index', compact('mangas'));
    }

    public function indexPlain()
    {
        $mangas = $this->mangas()->get();

        $volumeMapper = function ($volume) { return $volume->no; };
        $specialMapper = function ($special) { return $special->name; };
        $mangaMapper = function ($manga) use ($volumeMapper, $specialMapper) {
            return generateAsciiHeading($manga->name, '-')
                . "\n"
                . __('manga.index.mal_score') . ': ' . ($manga->malItem && $manga->malItem->score ? formatNumber($manga->malItem->score, 2) : 'n/a')
                . "\n"
                . __('validation.attributes.is_completed') . ': ' . formatBool($manga->is_completed)
                . "\n"
                . "\n"
                . implode("\n", $manga->volumes->map($volumeMapper)->toArray())
                . "\n"
                . implode("\n", $manga->specials->map($specialMapper)->toArray())
                . "\n"
                . "\n";
        };

        $content = implode("\n", $mangas->map($mangaMapper)->toArray());

        return response(view('manga.index_plain', compact('content')))->header('Content-Type', 'text/plain');
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

        return view('manga.statistics', compact('mangas', 'volumes', 'specials', 'latestVolumesAndSpecials'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRulesWithNameUniqueness());

        $this->createMalItemIfNecessary($request);

        $manga = new Manga($request->all());
        $manga->save();

        flash(__('manga.create.success'))->success();

        return redirect()->route('mangas.edit', [$manga]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manga  $manga
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manga  $manga
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
     * @param  Manga  $manga
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

    private function createMalItemIfNecessary($request)
    {
        $malId = $request->get('mal_id', null);
        $malItem = MalItem::find($malId);

        if (!$malItem || !$malItem->link_canonical) {
            Artisan::call("mal:get_item", ['mal_id' => $malId]);
        }
    }
}
