<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('social_link.index')->with([
            'socialLinks' => SocialLink::ordered()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('social_link.create')->with([
            'socialLink' => new SocialLink(),
            'nextOrder' => SocialLink::max('order') + 1,
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
            'order' => ['required', 'integer', 'min:0'],
            'url' => ['required', 'url'],
            'title' => ['required', 'string', 'max:255'],
        ]);

        $socialLink = new SocialLink($data);
        $socialLink->save();

        Cache::forget('social-links');

        flash(__('Social link added.'))->success();

        return redirect()->route('social_links.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(SocialLink $socialLink)
    {
        return view('social_link.edit')->with([
            'socialLink' => $socialLink,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialLink  $socialLink
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SocialLink $socialLink)
    {
        $data = $request->validate([
            'order' => ['required', 'integer', 'min:0'],
            'url' => ['required', 'url'],
            'title' => ['required', 'string', 'max:255'],
        ]);

        $socialLink->update($data);

        Cache::forget('social-links');

        flash(__('Social link saved.'))->success();

        return redirect()->route('social_links.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        Cache::forget('social-links');

        flash(__('Social link deleted.'))->success();

        return redirect()->route('social_links.index');
    }
}
