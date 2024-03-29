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
        return view('manga.index')->with([
            'mangas' => Manga::withVolumesAndSpecials()->get(),
        ]);
    }

    public function indexPlain()
    {
        $mangas = Manga::withVolumesAndSpecials()->get();

        $mangaMapperFn = function (Manga $manga) {
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
            $row->appendColumn(new Column(__('MAL score') . ':'));
            $row->appendColumn(new Column(($manga->malItem && $manga->malItem->score ? formatNumber($manga->malItem->score, 2) : 'n/a')));
            $table->appendRow($row);

            $row = new Row();
            $row->appendColumn(new Column(__('validation.attributes.is_completed') . ':'));
            $row->appendColumn(new Column(formatBool($manga->is_completed)));
            $table->appendRow($row);

            if ($volumes->isNotEmpty()) {
                $row = new Row();
                $row->appendColumn(new Column(trans_choice('common.volumes', $volumes) . ':'));
                $row->appendColumn(new Column((string)intRangeToStr($volumes->pluck('no'))));
                $table->appendRow($row);
            }

            if ($specials->isNotEmpty()) {
                $row = new Row();
                $row->appendColumn(new Column(trans_choice('common.specials', $specials) . ':'));
                $row->appendColumn(new Column($specials->implode('name', ', ')));
                $table->appendRow($row);
            }

            return $table->render();
        };

        $content = generateAsciiHeading(config('app.name')) . "\n\n" . implode("\n", $mangas->map($mangaMapperFn)->toArray());

        return response($content)->header('Content-Type', 'text/plain');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function manage()
    {
        return view('manga.manage')->with([
            'mangas' => Manga::orderBy('name')->get(),
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
            ->map(fn($volume) => new LatestEntry($volume->created_at, __('common.volume_of_manga', ['volume' => $volume->no, 'manga' => $volume->manga->name])))
            ->merge(
                $specials
                    ->take(5)
                    ->get()
                    ->map(fn($special) => new LatestEntry($special->created_at, __('common.special_of_manga', ['special' => $special->name, 'manga' => $special->manga->name])))
            )
            ->sortByDesc('created_at')->take(5);

        return view('manga.statistics')->with([
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
        return view('manga.create')->with([
            'manga' => new Manga(),
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
        $data = array_merge(
            $request->validate($this->rules()),
            ['is_completed' => $request->has('is_completed')],
        );

        $this->createMalItemIfNecessary($request);

        $manga = new Manga($data);
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
        return view('manga.edit')->with([
            'manga' => $manga,
            'newVolume' => new Volume(),
            'newSpecial' => new Special(),
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
        $data = array_merge(
            $request->validate($this->rules($manga)),
            ['is_completed' => $request->boolean('is_completed')],
        );

        $this->createMalItemIfNecessary($request);

        $manga->update($data);

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
                Rule::unique('mangas', 'name')->when($manga, fn($query) => $query->ignore($manga->id)),
            ],
            'is_completed' => 'nullable',
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
