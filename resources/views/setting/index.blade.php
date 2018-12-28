@extends('app')

@section('title', __('setting.index.title'))

@section('content')
    <h1>{{ __('setting.index.title') }}</h1>

    <p>
        {!! Html::decode(Html::linkRoute('settings.edit_password', '<i class="fas fa-key"></i> ' . __('setting.edit_password.title'))) !!}
    </p>
@endsection