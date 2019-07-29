<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    /**
     * @var string
     */
    private $redirectRoute = 'mangas.manage';

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

        return getViewByRequestType('recommendation.create', compact('recommendation'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recommendation $recommendation)
    {
        $recommendation->delete();

        flash(__('recommendation.destroy.success'))->success();

        return redirect()->route($this->redirectRoute);
    }
}
