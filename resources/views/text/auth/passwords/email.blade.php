@extends('text.app')

@section('title', __('auth.passwords.title'))

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{ Form::open(['route' => 'password.email', 'method' => 'post', 'role' => 'form']) }}
        <div class="form-group">
            <div>
                {{ Form::label('email', __('validation.attributes.email')) }}
            </div>

            <div>
                {{ Form::email('email', old('email'), ['class' => ($errors->has('email') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            {{ Form::button(__('auth.passwords.send_password_reset_link'), ['type' => 'submit']) }}
        </div>
    {{ Form::close() }}
@endsection
