@extends('layouts.app')

@section('title', __('manga.statistics.title'))

@section('content')
    <h1 class="headline-1">{{ __('manga.statistics.title') }}</h1>

    <div class="grid lg:grid-cols-2 gap-4">
        <div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white">
            <div class="px-6 py-4 mb-8">
                <div class="font-bold text-xl mb-2">
                    {{ __('manga.statistics.general') }}
                </div>

                <div>{{ trans_choice('manga.statistics.mangas', $mangas->count()) }}: {{ $mangas->count() }}</div>
                <div>{{ trans_choice('manga.statistics.volumes', $volumes->count()) }}: {{ $volumes->count() }}</div>
                <div>{{ trans_choice('manga.statistics.specials', $specials->count()) }}: {{ $specials->count() }}</div>
            </div>
        </div>

        <div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">
                    {{ __('manga.statistics.latest_volumes_and_specials') }}
                </div>

                @foreach ($latestVolumesAndSpecials as $entry)
                    <div>{{ $entry['name'] }}</div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
