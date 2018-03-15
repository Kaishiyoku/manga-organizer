@extends('app')

@section('title', 'New manga')

@section('content')
    <h1>New manga</h1>

    {{ Form::open(['route' => 'mangas.store', 'method' => 'post', 'role' => 'form']) }}
        @include('manga._form', ['submitTitle' => 'Create'])
    {{ Form::close() }}
@endsection
