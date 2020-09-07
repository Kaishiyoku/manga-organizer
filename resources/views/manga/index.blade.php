@extends('layouts.app')

@section('title', __('manga.index.title'))

@section('content')
    <h1 class="text-5xl mt-2 pb-4">{{ __('manga.index.title') }}</h1>

    <p class="pb-8">
        @auth
            {!! Html::decode(Html::linkRoute('mangas.manage', '<i class="fas fa-wrench"></i> ' . __('manga.index.manage'), [], ['class' => 'btn-default'])) !!}
        @else
            {!! Html::decode(Html::linkRoute('recommendations.create', '<i class="far fa-envelope-open"></i> ' . __('manga.index.recommend_me_a_manga'), [], ['class' => 'btn-default'])) !!}
        @endauth
    </p>

    @if ($mangas->count() == 0)
        <p class="lead"><i>{{ __('manga.no_mangas_yet') }}</i></p>
    @else
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 gap-x-4 gap-y-8">
            @foreach ($mangas as $manga)
                @include('manga._card')
            @endforeach
        </div>
    @endif
@endsection
