@extends('app')

@section('title', __('manga.create.title'))

@section('content')
    <h1>{{ __('manga.create.title') }}</h1>

    {{ Form::open(['route' => 'mangas.store', 'method' => 'post', 'role' => 'form']) }}
        @include('manga._form', ['submitTitle' => __('common.create')])
    {{ Form::close() }}
@endsection
