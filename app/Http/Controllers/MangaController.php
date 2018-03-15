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

        return view('manga.index', compact('mangas'));
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

        return redirect()->route($this->redirectRoute);
    }

    private function getValidationRulesWithNameUniqueness($id = null)
    {
        $nameUniquessRule = Rule::unique('mangas', 'name');

        if ($id != null) {
            $nameUniquessRule = $nameUniquessRule->ignore($id);
        }

        $validationRules = $this->validationRules;
        $validationRules['name'][] = $nameUniquessRule;

        return $validationRules;
    }
}
