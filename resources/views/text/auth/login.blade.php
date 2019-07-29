@extends('text.app')

@section('title', 'Login')

@section('content')
    <h1>{{ __('auth.login.title') }}</h1>

    {{ Form::open(['route' => 'login', 'method' => 'post', 'role' => 'form']) }}
        <div class="form-group">
            <div>
                {{ Form::label('email', __('validation.attributes.email')) }}
            </div>

            <div>
                {{ Form::email('email', old('email'), ['class' => ($errors->has('email') ? ' is-invalid' : ''), 'required' => true, 'autofocus' => true]) }}

                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div>
                {{ Form::label('password', __('validation.attributes.password')) }}
            </div>

            <div class="col-md-12">
                {{ Form::password('password', ['class' => ($errors->has('password') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div>
                {{ Form::checkbox('remember', 1, old('remember'), ['id' => 'remember']) }}

                <label for="remember">{{ __('auth.passwords.remember_me') }}</label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::button(__('common.login'), ['type' => 'submit']) }}

            {{ Html::linkRoute('password.request', __('auth.passwords.forgot_your_password')) }}
        </div>
    {{ Form::close() }}
@endsection
