<?php

namespace App\Http\Controllers;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = app('db')
            ->table('mangas')
            ->select('mangas.*', 'volumes.*')
            ->join('volumes as volumes', 'mangas.id', '=', 'volumes.manga_id')
            ->orderBy('mangas.name', 'asc')
            ->orderBy('volumes.number', 'asc')
            ->get();

        return view('manga.index', compact('mangas'));
    }
}
