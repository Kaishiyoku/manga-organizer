@extends('layouts.app')

@section('title', __('manga.edit.title', ['name' => $manga->name]))

@section('content')
    <h1 class="text-5xl">{{ __('manga.edit.title', ['name' => $manga->name]) }}</h1>

    {{ Form::open(['route' => ['mangas.update', $manga->id], 'method' => 'put', 'role' => 'form']) }}
        @include('manga._form', ['submitTitle' => '<i class="fas fa-save"></i> ' . __('common.update')])
    {{ Form::close() }}

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            @include('manga._volumes')
        </div>

        <div>
            @include('manga._specials')
        </div>
    </div>

    <div class="mt-8">{!! Html::decode(Html::linkRoute('mangas.manage', '<i class="fas fa-arrow-left"></i> ' . __('common.back'), null, ['class' => 'link-default'])) !!}</div>
@endsection
