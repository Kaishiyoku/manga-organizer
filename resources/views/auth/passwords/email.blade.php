@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {{ Form::open(['route' => 'password.email', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) }}
                <div class="form-group">
                    {{ Form::label('email', __('validation.attributes.email'), ['class' => 'col-md-12 control-label']) }}

                    <div class="col-md-12">
                        {{ Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required' => true]) }}

                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        {{ Form::button(__('auth.passwords.send_password_reset_link'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
