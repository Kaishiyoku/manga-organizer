<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    /**
     * @var array
     */
    private $validationRules = [
        'manga' => 'required',
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recommendation = new Recommendation();

        return view('recommendation.create', compact('recommendation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $recommendation = new Recommendation($request->all());
        $recommendation->ip_address = $request->ip();
        $recommendation->save();

        flash(__('recommendation.create.success'))->success();

        return redirect('/');
    }
}
