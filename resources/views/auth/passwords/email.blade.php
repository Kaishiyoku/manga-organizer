@extends('layouts.app')

@section('title', __('auth.passwords.reset_password'))

@section('content')
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-md">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col break-words mt-4">
                <h1 class="text-2xl">{{ __('auth.passwords.reset_password') }}</h1>

                <form class="w-full p-6" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="label-default">
                            {{ __('validation.attributes.email') }}:
                        </label>

                        <input id="email" type="email" class="input-default @error('email') has-error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('validation.attributes.email') }}" autofocus>

                        @error('email')
                            <p class="validation-error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit" class="btn-default">
                            {{ __('auth.passwords.send_password_reset_link') }}
                        </button>

                        <p class="w-full text-center text-gray-700 mt-8 -mb-4">
                            <a class="link-default text-sm" href="{{ route('login') }}">
                                {{ __('auth.passwords.back_to_login') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
