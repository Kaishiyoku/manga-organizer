@extends('app')

@section('title', __('manga.edit.title', ['name' => $manga->name]))

@section('content')
    <h1>{{ __('manga.edit.title', ['name' => $manga->name]) }}</h1>

    <div class="row">
        <div class="col-lg-6">
            {{ Form::open(['route' => ['mangas.update', $manga->id], 'method' => 'put', 'role' => 'form']) }}
                @include('manga._form', ['submitTitle' => __('common.update')])
            {{ Form::close() }}
        </div>

        <div class="col-lg-6">
            @include('manga._volumes')
        </div>
    </div>

    {{ Html::linkRoute('mangas.manage', __('common.back')) }}
@endsection
