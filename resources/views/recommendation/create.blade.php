@extends('layouts.app')

@section('title', __('recommendation.create.title'))

@section('content')
    <h1>{{ __('recommendation.create.title') }}</h1>

    {{ Form::open(['route' => 'recommendations.store', 'method' => 'post', 'role' => 'form']) }}
        <div class="form-group row">
            {{ Form::label('manga', __('validation.attributes.manga'), ['class' => 'col-lg-12 control-label']) }}

            <div class="col-lg-12">
                {{ Form::text('manga', old('manga', $recommendation->manga), ['class' => 'form-control' . ($errors->has('manga') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('manga'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manga') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
                {!! Html::decode(Form::button(__('recommendation.create.submit'), ['type' => 'submit', 'class' => 'btn btn-primary'])) !!}
            </div>
        </div>
    {{ Form::close() }}
@endsection
