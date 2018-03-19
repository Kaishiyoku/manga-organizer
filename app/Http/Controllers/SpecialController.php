<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Special;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpecialController extends Controller
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

        $volume = new Special($request->all());
        $manga->specials()->save($volume);

        flash(__('special.create.success'))->success();

        return redirect()->route($this->redirectRoute, [$manga]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Manga  $manga
     * @param  Special $special
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manga $manga, Special $special)
    {
        $manga->specials->find($special)->delete();

        flash(__('special.destroy.success'))->success();

        return redirect()->route($this->redirectRoute, [$manga]);
    }

    /**
     * @return array
     */
    private function validationRules($manga) {
        return [
            'name' => ['required', 'string', Rule::unique('specials', 'name')->where(function ($query) use ($manga) {
                return $query->whereMangaId($manga->id);
            })],
        ];
    }
}
