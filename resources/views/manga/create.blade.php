@extends('layouts.app')

@section('title', __('manga.create.title'))

@section('content')
    <h1>{{ __('manga.create.title') }}</h1>

    {{ Form::open(['route' => 'mangas.store', 'method' => 'post', 'role' => 'form']) }}
        @include('manga._form', ['submitTitle' => '<i class="fas fa-save"></i> ' . __('common.create')])
    {{ Form::close() }}

    {!! Html::decode(Html::linkRoute('mangas.manage', '<i class="fas fa-arrow-left"></i> ' . __('common.back'))) !!}
@endsection
