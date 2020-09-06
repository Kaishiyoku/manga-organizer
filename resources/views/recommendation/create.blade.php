@extends('layouts.app')

@section('title', __('recommendation.create.title'))

@section('content')
    <h1 class="text-5xl">{{ __('recommendation.create.title') }}</h1>

    {{ Form::open(['route' => 'recommendations.store', 'method' => 'post', 'role' => 'form']) }}
        <div class="mb-4">
            {{ Form::label('manga', __('validation.attributes.manga'), ['class' => 'label-default']) }}

            {{ Form::text('manga', old('manga', $recommendation->manga), ['class' => 'input-default' . ($errors->has('manga') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.manga')]) }}

            @if ($errors->has('manga'))
                <p class="validation-error">
                    {{ $errors->first('manga') }}
                </p>
            @endif
        </div>

        {!! Html::decode(Form::button(__('recommendation.create.submit'), ['type' => 'submit', 'class' => 'border border-purple-600 bg-purple-500 text-white py-2 px-3 hover:bg-purple-900 transition-all duration-150 rounded shadow focus:shadow-outline'])) !!}
    {{ Form::close() }}
@endsection
