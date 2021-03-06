<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app_text.css') }}">
</head>
<body>

<h1>
    {{ env('APP_NAME', 'Laravel') }}
</h1>

<div>
    {{ Html::linkRoute('mangas.index', __('common.manga_list')) }}
    {{ Html::linkRoute('mangas.statistics', __('common.statistics')) }}

    @auth
        {{ Html::link('mangas.manage', __('common.manage_mangas')) }}
    @else
        {{ Html::linkRoute('recommendations.create', __('common.recommend_manga')) }}
    @endauth
</div>

<div>

</div>

<div>
    @include('flash::message')

    @yield('content')
</div>

<footer>
    @if (env('APP_CREATION_YEAR') == date('Y'))
        {{ env('APP_CREATION_YEAR') }},
    @else
        {{ env('APP_CREATION_YEAR') }} - {{ date('Y') }},
    @endif

    {{ env('APP_AUTHOR') }} &#8226;
    v{{ env('APP_VERSION') }} &#8226;

    @if (auth()->check())
        {!! Html::decode(Html::linkRoute('settings.index', __('common.settings'))) !!}
    @endif

    {!! Html::decode(Html::linkRoute('mangas.index_plain', __('common.list_as_text'))) !!}

    &#8226;

    {!! Html::decode(Html::linkRoute('home.show_contact_form', __('common.contact'))) !!}
</footer>

@foreach (config('app.available_locales') as $locale)
    {{ Form::open(['route' => 'language.change', 'method' => 'post', 'id' => 'lang-form-' . $locale, 'style' => 'display: none;']) }}
        {{ Form::hidden('locale', $locale) }}
    {{ Form::close() }}
@endforeach

@auth
    @include('shared._logout_form')
@endauth

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
