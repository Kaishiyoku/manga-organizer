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

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container cover">
    <a href="{{ route('mangas.index') }}">
        <img src="{{ asset('img/cover.png') }}" class="img-fluid" alt="Cover"/>
    </a>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        {!! Html::decode(Html::link('/', '<i class="fas fa-home"></i>', ['class' => 'navbar-brand'])) !!}

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('common.toggle_navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                {!! Menu::render() !!}
            </ul>

            <ul class="navbar-nav">
                {!! Menu::render('right') !!}
            </ul>
        </div>
    </nav>
</div>

<div class="container">
    @include('flash::message')

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
                <i class="fas fa-sign-out"></i> {{ __('common.logout') }}
            </a>

            {{ Form::open(['route' => 'logout', 'method' => 'post', 'id' => 'logout-form', 'style' => 'display: none;']) }}
            {{ Form::close() }}
        @else
            {!! Html::decode(Html::linkRoute('login_form', '<i class="fas fa-sign-in"></i> ' . __('common.login'))) !!}
        @endif

        &#8226;

        {!! Html::decode(Html::linkRoute('mangas.index_plain', '<i class="far fa-file-alt"></i> ' . __('common.list_as_text'))) !!}

        &#8226;

        {!! Html::decode(Html::linkRoute('home.show_contact_form', '<i class="far fa-envelope"></i> ' . __('common.contact'))) !!}
    </footer>
</div>

@foreach (config('app.available_locales') as $locale)
    {{ Form::open(['route' => 'language.change', 'method' => 'post', 'id' => 'lang-form-' . $locale, 'style' => 'display: none;']) }}
        {{ Form::hidden('locale', $locale) }}
    {{ Form::close() }}
@endforeach

<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
    $("[id^=lang-link-]").click(function (e) {
        $this = $(this);
        e.preventDefault();

        $('#' + $this.attr('id').replace('link', 'form')).submit();
    });
</script>

</body>
</html>