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
        return view('recommendation.index')->with([
                'recommendations' => Recommendation::orderByDesc('created_at')->get(),
            ]
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('recommendation.create')->with([
            'recommendation' => new Recommendation(),
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
        $data = $request->validate([
            'manga' => 'required',
        ]);

        $recommendation = new Recommendation($data);
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
