@extends('layouts.app')

@section('title', __('manga.index.title'))

@section('content')
    <h1 class="headline-1">{{ __('manga.index.title') }}</h1>

    <div class="mb-8 mt-4">
        @auth
            {!! Html::decode(Html::linkRoute('mangas.manage', '<i class="fas fa-wrench"></i> ' . __('manga.index.manage'), [], ['class' => 'btn-default'])) !!}
        @else
            {!! Html::decode(Html::linkRoute('recommendations.create', '<i class="far fa-envelope-open"></i> ' . __('manga.index.recommend_me_a_manga'), [], ['class' => 'btn-default'])) !!}
        @endauth
    </div>

    @if ($mangas->count() === 0)
        <p class="italic text-gray-500 text-xl">{{ __('manga.no_mangas_yet') }}</p>
    @else
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 gap-x-4 gap-y-8">
            @foreach ($mangas as $manga)
                @include('manga._card')
            @endforeach
        </div>
    @endif
@endsection
