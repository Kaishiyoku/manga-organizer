@extends('app')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            {{ Form::open(['route' => 'login', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) }}
                <div class="form-group">
                    {{ Form::label('email', __('validation.attributes.email'), ['class' => 'col-md-12 control-label']) }}

                    <div class="col-md-12">
                        {{ Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required' => true, 'autofocus' => true]) }}

                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('password', __('validation.attributes.password'), ['class' => 'col-md-12 control-label']) }}

                    <div class="col-md-12">
                        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'required' => true]) }}

                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            {{ Form::checkbox('remember', 1, old('remember'), ['class' => 'custom-control-input', 'id' => 'remember']) }}

                            <label class="custom-control-label" for="remember">{{ __('auth.passwords.remember_me') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        {{ Form::button(__('common.login'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}

                        {{ Html::linkRoute('password.request', __('auth.passwords.forgot_your_password'), ['class' => 'btn btn-link']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
