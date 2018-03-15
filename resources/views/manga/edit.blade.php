@extends('app')

@section('title', __('manga.edit.title', ['name' => $manga->name]))

@section('content')
    <h1>{{ __('manga.edit.title', ['name' => $manga->name]) }}</h1>

    {{ Form::open(['route' => ['mangas.update', $manga->id], 'method' => 'put', 'role' => 'form']) }}
        @include('manga._form', ['submitTitle' => __('common.update')])
    {{ Form::close() }}
@endsection
