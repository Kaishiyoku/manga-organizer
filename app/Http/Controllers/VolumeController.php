<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VolumeController extends Controller
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
        $request->validate([
            'no' => ['required', 'integer', 'min:1', Rule::unique('volumes', 'no')->where(function ($query) use ($manga) {
                return $query->whereMangaId($manga->id);
            })],
        ]);

        $volume = new Volume($request->all());
        $manga->volumes()->save($volume);

        flash(__('Volume added.'))->success();

        return redirect()->route('mangas.edit', $manga);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Manga  $manga
     * @param  Volume $volume
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Manga $manga, Volume $volume)
    {
        $manga->volumes->find($volume)->delete();

        flash(__('Volume deleted.'))->success();

        return redirect()->route('mangas.edit', $manga);
    }
}
