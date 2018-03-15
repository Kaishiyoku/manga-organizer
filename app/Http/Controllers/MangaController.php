<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MangaController extends Controller
{
    /**
     * @var string
     */
    private $redirectRoute = 'mangas.index';

    /**
     * @var array
     */
    private $validationRules = [
        'name' => ['required'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mangas = Manga::all();
        $mangasWithoutVolumes = $mangas->filter(function ($manga) {
            return $manga->volumes->count() == 0;
        });

        return view('manga.index', compact('mangas', 'mangasWithoutVolumes'));
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

        flash('Manga created.')->success();

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manga  $manga
     * @return \Illuminate\Http\Response
     */
    public function edit(Manga $manga)
    {
        return view('manga.edit', compact('manga'));
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
        $manga->save();

        flash('Manga updated.')->success();

        return redirect()->route($this->redirectRoute);
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
