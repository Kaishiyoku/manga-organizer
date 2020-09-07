@extends('layouts.app')

@section('title', __('manga.statistics.title'))

@section('content')
    <h1 class="text-5xl mt-2">{{ __('manga.statistics.title') }}</h1>

    <ul class="list-disc ml-8">
        <li>
            {{ $mangas->count() }} {{ trans_choice('manga.statistics.mangas', $mangas->count()) }}
        </li>
        <li>
            {{ $volumes->count() }} {{ trans_choice('manga.statistics.volumes', $volumes->count()) }}
        </li>
        <li>
            {{ $specials->count() }} {{ trans_choice('manga.statistics.specials', $specials->count()) }}
        </li>
    </ul>

    <h2 class="text-4xl">{{ __('manga.statistics.latest_volumes_and_specials') }}</h2>

    <ul class="list-disc ml-8">
        @foreach ($latestVolumesAndSpecials as $entry)
            <li>
                {{ $entry['name'] }}
            </li>
        @endforeach
    </ul>
@endsection
