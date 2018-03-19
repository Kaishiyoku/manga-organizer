<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VolumeController extends Controller
{
    /**
     * @var string
     */
    private $redirectRoute = 'mangas.edit';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Manga $manga
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Manga $manga)
    {
        $request->validate($this->validationRules($manga));

        $volume = new Volume($request->all());
        $manga->volumes()->save($volume);

        flash(__('volume.create.success'))->success();

        return redirect()->route($this->redirectRoute, [$manga]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Manga  $manga
     * @param  Volume $volume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manga $manga, Volume $volume)
    {
        $manga->volumes->find($volume)->delete();

        flash(__('volume.destroy.success'))->success();

        return redirect()->route($this->redirectRoute, [$manga]);
    }

    /**
     * @return array
     */
    private function validationRules($manga) {
        return [
            'no' => ['required', 'integer', 'min:1', Rule::unique('volumes', 'no')->where(function ($query) use ($manga) {
                return $query->whereMangaId($manga->id);
            })],
        ];
    }
}
