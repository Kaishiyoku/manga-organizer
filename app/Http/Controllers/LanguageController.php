<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        $locale = $request->get('locale');

        if (in_array($locale, config('app.available_locales'))) {
            if (auth()->check()) {
                auth()->user()->locale = $locale;
                auth()->user()->save();
            }

            Session::put('locale', $locale);
        } else {
            flash(__('language.invalid_locale'))->error();
        }

        return back();
    }
}
