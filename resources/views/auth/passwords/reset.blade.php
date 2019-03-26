@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            {{ Form::open(['route' => 'password.request', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) }}
                {{ Form::hidden('token', $token) }}

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
                    {{ Form::label('password_confirmation', __('validation.attributes.password_confirmation'), ['class' => 'col-md-12 control-label']) }}

                    <div class="col-md-12">
                        {{ Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'required' => true]) }}

                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        {{ Form::button(__('auth.passwords.reset_password'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
