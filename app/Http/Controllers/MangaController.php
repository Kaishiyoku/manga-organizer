<?php

namespace App\Http\Controllers;

use App\Models\Manga;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::all();

        return view('manga.index', compact('mangas'));
    }
}
