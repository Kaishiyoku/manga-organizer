<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Special;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpecialController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Manga $manga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Manga $manga)
    {
        $data = $request->validate([
            'name' => ['required', 'string', Rule::unique('specials', 'name')->where(fn($query) => $query->whereMangaId($manga->id))],
        ]);

        $volume = new Special($data);
        $manga->specials()->save($volume);

        flash(__('Special added.'))->success();

        return redirect()->route('mangas.edit', $manga);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Manga  $manga
     * @param  Special $special
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Manga $manga, Special $special)
    {
        $manga->specials()->find($special)->delete();

        flash(__('Special deleted.'))->success();

        return redirect()->route('mangas.edit', $manga);
    }
}
