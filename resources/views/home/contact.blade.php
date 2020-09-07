@extends('layouts.app')

@section('title', __('home.contact.title'))

@section('content')
    <h1 class="headline-1">{{ __('home.contact.title') }}</h1>

    {{ Form::open(['route' => 'home.send_contact_form', 'method' => 'post', 'role' => 'form']) }}
        <div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white px-6 py-4 mb-8">
            @captcha()

            <div class="mb-4">
                {{ Form::label('email', __('validation.attributes.email'), ['class' => 'label-default']) }}

                {{ Form::email('email', old('email'), ['class' => 'input-default' . ($errors->has('email') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.email')]) }}

                @if ($errors->has('email'))
                    <p class="validation-error">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>

            <div class="mb-4">
                {{ Form::label('fullname', __('validation.attributes.fullname'), ['class' => 'label-default']) }}

                {{ Form::text('fullname', old('fullname'), ['class' => 'input-default' . ($errors->has('fullname') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.fullname')]) }}

                @if ($errors->has('fullname'))
                    <p class="validation-error">
                        {{ $errors->first('fullname') }}
                    </p>
                @endif
            </div>

            <div class="mb-4">
                {{ Form::label('content', __('validation.attributes.content'), ['class' => 'label-default']) }}

                {{ Form::textarea('content', old('content'), ['class' => 'input-default' . ($errors->has('content') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.content')]) }}

                @if ($errors->has('content'))
                    <p class="validation-error">
                        {{ $errors->first('content') }}
                    </p>
                @endif
            </div>
        </div>

        {{ Form::button(__('common.contact_me_now'), ['type' => 'submit', 'class' => 'border border-purple-600 bg-purple-500 text-white py-2 px-3 hover:bg-purple-900 transition-all duration-150 rounded shadow focus:shadow-outline']) }}
    {{ Form::close() }}
@endsection
