@extends('layouts.app')

@section('title', __('setting.index.title'))

@section('content')
    <h1 class="headline-1">{{ __('setting.index.title') }}</h1>

    <div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white px-6 py-4">
        {!! Html::decode(Html::linkRoute('settings.edit_password', '<i class="fas fa-key"></i> ' . __('setting.edit_password.title'), null, ['class' => 'link-default'])) !!}
    </div>
@endsection
