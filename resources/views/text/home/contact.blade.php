@extends('text.app')

@section('title', __('home.contact.title'))

@section('content')
    <h1>{{ __('home.contact.title') }}</h1>

    {{ Form::open(['route' => 'home.send_contact_form', 'method' => 'post', 'role' => 'form']) }}
        @captcha()

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
            <div>
                {{ Form::label('fullname', trans('validation.attributes.fullname')) }}
            </div>

            <div>
                {{ Form::text('fullname', old('fullname'), ['class' => ($errors->has('fullname') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('fullname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fullname') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div>
                {{ Form::label('content', trans('validation.attributes.content')) }}
            </div>

            <div>
                {{ Form::textarea('content', old('content'), [($errors->has('content') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            {{ Form::button(__('common.contact_me_now'), ['type' => 'submit']) }}
        </div>
    {{ Form::close() }}
@endsection
