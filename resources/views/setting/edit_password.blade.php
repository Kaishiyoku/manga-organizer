@extends('layouts.app')

@section('content')
    <h1>{{ __('setting.edit_password.title') }}</h1>

    {{ Form::open(['route' => 'settings.update_password', 'method' => 'put', 'role' => 'form']) }}
    <div class="form-group row">
        {{ Form::label('current_password', __('validation.attributes.current_password'), ['class' => 'col-lg-3 col-form-label']) }}

        <div class="col-lg-3">
            {{ Form::password('current_password', ['class' => 'form-control' . ($errors->has('current_password') ? ' is-invalid' : ''), 'required' => true]) }}

            @if ($errors->has('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->first('current_password') }}
                </div>
            @endif
        </div>
    </div>

    <hr/>

    <div class="form-group row">
        {{ Form::label('new_password', __('validation.attributes.new_password'), ['class' => 'col-lg-3 col-form-label']) }}

        <div class="col-lg-3">
            {{ Form::password('new_password', ['class' => 'form-control' . ($errors->has('new_password') ? ' is-invalid' : ''), 'required' => true, 'data-provide' => 'password-strength']) }}

            @if ($errors->has('new_password'))
                <div class="invalid-feedback">
                    {{ $errors->first('new_password') }}
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        {{ Form::label('new_password_confirmation', __('validation.attributes.new_password_confirmation'), ['class' => 'col-lg-3 col-form-label']) }}

        <div class="col-lg-3">
            {{ Form::password('new_password_confirmation', ['class' => 'form-control' . ($errors->has('new_password_confirmation') ? ' is-invalid' : ''), 'required' => true]) }}

            @if ($errors->has('new_password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->first('new_password_confirmation') }}
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-9 ml-md-auto">
            {{ Form::button(__('setting.edit_password.submit'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    </div>
    {{ Form::close() }}
@endsection
