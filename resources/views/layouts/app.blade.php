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

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/additions.css') }}">
</head>
<body class="bg-gray-100">

<div class="container lg:px-20 mx-auto">
    <a href="{{ route('mangas.index') }}">
        <img src="{{ asset('img/cover.jpg') }}" class="w-full h-72 object-cover object-top" alt="Cover"/>
    </a>

    <div class="flex flex-wrap justify-between bg-gray-700">
        {!! \LaravelMenu::render() !!}

        <div class="flex flex-wrap">
            @if (env('MAL_PROFILE_URL'))
                <a href="{{ env('MAL_PROFILE_URL') }}" class="group flex items-center navbar-link">
                    <span class="mr-1">{{ __('common.mal_profile') }}</span>
                    <span class="text-xs text-gray-500 group-hover:text-gray-300">
                        <i class="fas fa-external-link-alt"></i>
                    </span>
                </a>
            @endif

            @auth
                {{ Html::link('#', __('common.logout'), ['data-click' => '#logout-form', 'class' => 'navbar-link']) }}
            @else
                {{ Html::linkRoute('login_form', __('common.login'), null, ['class' => 'navbar-link' . (request()->is('login') ? ' navbar-link-active' : '')]) }}
            @endauth

            @include('shared._locale_dropdown')
        </div>
    </div>
</div>

<div class="container px-4 lg:px-20 mx-auto">
    @include('flash::message')

    @yield('content')
</div>

<div class="container px-4 lg:px-20 mt-16 mb-8 mx-auto text-gray-500">
    <footer class="flex">
        @if (auth()->check())
            {!! Html::decode(Html::linkRoute('settings.index', '<span class="hidden sm:inline"><i class="fas fa-wrench"></i></span> ' . __('common.settings'), null, ['class' => 'link-alternative flex-grow lg:flex-grow-0 rounded-l-md'])) !!}
        @endif

        {!! Html::decode(Html::linkRoute('mangas.index_plain', '<span class="hidden sm:inline"><i class="fas fa-file-alt"></i></span> ' . __('common.list_as_text'), null, ['class' => 'link-alternative flex-grow lg:flex-grow-0'])) !!}

        {!! Html::decode(Html::linkRoute('home.show_contact_form', '<span class="hidden sm:inline"><i class="fas fa-envelope"></i></span> ' . __('common.contact'), null, ['class' => 'link-alternative flex-grow lg:flex-grow-0 rounded-r-md'])) !!}
    </footer>
</div>

@foreach (config('app.available_locales') as $locale)
    {{ Form::open(['route' => 'language.change', 'method' => 'post', 'id' => 'lang-form-' . $locale, 'style' => 'display: none;']) }}
        {{ Form::hidden('locale', $locale) }}
    {{ Form::close() }}
@endforeach

@auth
    @include('shared._logout_form')
@endauth

<script type="text/javascript">
    window.config = @json(__('common.javascript_config'));
</script>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
