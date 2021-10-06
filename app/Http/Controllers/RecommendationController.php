<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $recommendations = Recommendation::orderBy('created_at', 'desc')->get();

        return view('recommendation.index', [
            'recommendations' => $recommendations,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $recommendation = new Recommendation();

        return view('recommendation.create', [
            'recommendation' => $recommendation,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'manga' => 'required',
        ]);

        $recommendation = new Recommendation($request->all());
        $recommendation->ip_address = $request->ip();
        $recommendation->save();

        flash(__('Manga recommendation sent. Thank you.'))->success();

        return redirect()->route('mangas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Recommendation  $recommendation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Recommendation $recommendation)
    {
        $recommendation->delete();

        flash(__('Recommendation deleted.'))->success();

        return redirect()->route('recommendations.index');
    }
}
