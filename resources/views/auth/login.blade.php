@extends('layouts.app')

@section('title', __('auth.login.title'))

@section('content')
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <div class="flex flex-col break-words">
                <form class="w-full p-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
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

                    <div class="mb-4">
                        <label for="password" class="label-default">
                            {{ __('validation.attributes.password') }}:
                        </label>

                        <input id="password" type="password" class="input-default @error('password') has-error @enderror" name="password" required placeholder="{{ __('validation.attributes.password') }}">

                        @error('password')
                        <p class="validation-error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('auth.passwords.remember_me') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <button type="submit" class="btn-default">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-purple-500 hover:text-purple-700 whitespace-no-wrap no-underline ml-auto" href="{{ route('password.request') }}">
                                {{ __('auth.passwords.forgot_your_password') }}
                            </a>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
