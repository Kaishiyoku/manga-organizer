<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ env('APP_NAME', 'Laravel') }}
        -
        @yield('title')
    </title>

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container">
    <a href="{{ route('mangas.index') }}">
        <img src="{{ asset('img/cover.png') }}" class="cover img-fluid" alt="Cover"/>
    </a>
</div>

<div class="container">
    @yield('content')
</div>

<div class="container text-muted">
    <footer>
        @if (env('APP_CREATION_YEAR') == date('Y'))
            {{ env('APP_CREATION_YEAR') }},
        @else
            {{ env('APP_CREATION_YEAR') }} - {{ date('Y') }},
        @endif

        {{ env('APP_AUTHOR') }} &#8226;
        v{{ env('APP_VERSION') }} &#8226;

        @if (auth()->check())
            <a href="#" data-submit="#logout-form">
                Logout
            </a>

            {{ Form::open(['route' => 'logout', 'method' => 'post', 'id' => 'logout-form', 'style' => 'display: none;']) }}
            {{ Form::close() }}
        @else
            {{ Html::linkRoute('login_form', 'Login') }}
        @endif
    </footer>
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
