@extends('layouts.app')

@section('title', __('recommendation.create.title'))

@section('content')
    <h1 class="headline-1">{{ __('recommendation.create.title') }}</h1>

    {{ Form::open(['route' => 'recommendations.store', 'method' => 'post', 'role' => 'form']) }}
        <div class="rounded overflow-hidden shadow border border-gray-200 bg-white px-6 py-4 mb-8">
            <div class="mb-4">
                {{ Form::label('manga', __('validation.attributes.manga'), ['class' => 'label-default']) }}

                {{ Form::text('manga', old('manga', $recommendation->manga), ['class' => 'input-default' . ($errors->has('manga') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.manga')]) }}

                @if ($errors->has('manga'))
                    <p class="validation-error">
                        {{ $errors->first('manga') }}
                    </p>
                @endif
            </div>
        </div>

        {!! Html::decode(Form::button(__('recommendation.create.submit'), ['type' => 'submit', 'class' => 'btn-default'])) !!}
    {{ Form::close() }}
@endsection
