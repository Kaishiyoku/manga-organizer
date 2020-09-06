@extends('layouts.app')

@section('content')
    <h1 class="text-5xl">{{ __('setting.edit_password.title') }}</h1>

    {{ Form::open(['route' => 'settings.update_password', 'method' => 'put', 'role' => 'form']) }}
        <div class="mb-8">
            {{ Form::label('current_password', __('validation.attributes.current_password'), ['class' => 'label-default']) }}

            {{ Form::password('current_password', ['class' => 'input-default' . ($errors->has('current_password') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.current_password')]) }}

            @if ($errors->has('current_password'))
                <p class="validation-error">
                    {{ $errors->first('current_password') }}
                </p>
            @endif
        </div>

        <div class="bg-gray-200 h-1 w-1/4 mx-auto mb-4"></div>

        <div class="mb-4">
            {{ Form::label('new_password', __('validation.attributes.new_password'), ['class' => 'label-default']) }}

            {{ Form::password('new_password', ['class' => 'input-default' . ($errors->has('new_password') ? ' has-error' : ''), 'required' => true, 'data-provide' => 'password-strength', 'placeholder' => __('validation.attributes.new_password')]) }}

            @if ($errors->has('new_password'))
                <p class="validation-error">
                    {{ $errors->first('new_password') }}
                </p>
            @endif
        </div>

        <div class="mb-4">
            {{ Form::label('new_password_confirmation', __('validation.attributes.new_password_confirmation'), ['class' => 'label-default']) }}

            {{ Form::password('new_password_confirmation', ['class' => 'input-default' . ($errors->has('new_password_confirmation') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.new_password_confirmation')]) }}

            @if ($errors->has('new_password_confirmation'))
                <p class="validation-error">
                    {{ $errors->first('new_password_confirmation') }}
                </p>
            @endif
        </div>

        <div class="form-group row">
            <div class="col-lg-9 ml-md-auto">
                {{ Form::button(__('setting.edit_password.submit'), ['type' => 'submit', 'class' => 'btn-default']) }}
            </div>
        </div>
    {{ Form::close() }}
@endsection
