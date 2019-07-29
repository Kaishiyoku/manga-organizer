@extends('text.app')

@section('title', __('recommendation.create.title'))

@section('content')
    <h1>{{ __('recommendation.create.title') }}</h1>

    {{ Form::open(['route' => 'recommendations.store', 'method' => 'post', 'role' => 'form']) }}
        <div class="form-group">
            <div>
                {{ Form::label('manga', __('validation.attributes.manga')) }}
            </div>

            <div>
                {{ Form::text('manga', old('manga', $recommendation->manga), ['class' => ($errors->has('manga') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('manga'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manga') }}
                    </div>
                @endif
            </div>
        </div>

        <div>
            <div>
                {{ Form::button(__('recommendation.create.submit'), ['type' => 'submit']) }}
            </div>
        </div>
    {{ Form::close() }}
@endsection
