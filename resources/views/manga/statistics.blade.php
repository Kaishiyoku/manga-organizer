@extends('app')

@section('title', __('manga.statistics.title'))

@section('content')
    <h1>{{ __('manga.statistics.title') }}</h1>

    <ul>
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

    <h2>{{ __('manga.statistics.latest_volumes_and_specials') }}</h2>

    <ul>
        @foreach ($latestVolumesAndSpecials as $entry)
            <li>
                {{ $entry['name'] }}
            </li>
        @endforeach
    </ul>
@endsection