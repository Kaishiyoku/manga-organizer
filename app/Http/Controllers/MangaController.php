<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Special;
use App\Models\Volume;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

        $renderer = new ArrayToTextTable($mangas->flatMap(function ($manga) {
            return array_merge($manga->volumes->map(function ($volume) use ($manga) {
                return [
                    __('validation.attributes.name') => $manga->name,
                    __('validation.attributes.volume') => $volume->no
                ];
            })->toArray(), $manga->specials->map(function ($special) use ($manga) {
                return [
                    __('validation.attributes.name') => $manga->name,
                    __('validation.attributes.volume') => $special->name
                ];
            })->toArray());
        })->toArray());

        $renderer->setKeysAlignment(ArrayToTextTable::AlignLeft);
        $renderer->setDecorator(new \Zend\Text\Table\Decorator\Blank());

        return response(view('manga.index_plain', ['mangaTable' => $renderer->getTable()]))->header('Content-Type', 'text/plain');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $mangas = Manga::orderBy('name')->get();

        return view('manga.manage', compact('mangas'));
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
}
