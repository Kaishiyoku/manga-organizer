@extends('app')

@section('title', 'Edit manga “' . $manga->name . '”')

@section('content')
    <h1>Edit manga “{{ $manga->name }}”</h1>

    {{ Form::open(['route' => ['mangas.update', $manga->id], 'method' => 'put', 'role' => 'form']) }}
        @include('manga._form', ['submitTitle' => 'Update'])
    {{ Form::close() }}
@endsection
