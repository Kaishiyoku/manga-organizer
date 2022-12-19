@php
    $classes = [
        'inline-flex items-center space-x-1 transition ease-in disabled:opacity-50 disabled:cursor-not-allowed',
        'font-semibold text-xs uppercase tracking-widest border focus:outline-none focus:ring-1' => !$link,
        'shadow focus:shadow-md dark:shadow-black/25' => !$plain && !$link,
        'text-white border-purple-600 bg-purple-500 hover:border-purple-700 hover:bg-purple-600 focus:ring-purple-600 dark:border-purple-500 dark:bg-purple-600 dark:hover:border-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-500' => $primary,
        'text-gray-900 border-gray-300 bg-white hover:border-gray-300 hover:bg-gray-100 focus:ring-gray-300 dark:text-white dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-600' => $secondary,
        'text-gray-900 border-transparent hover:bg-gray-200 focus:ring-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-gray-600' => $plain,
        'text-white border-pink-600 bg-pink-500 hover:border-pink-700 hover:bg-pink-600 focus:ring-pink-600 dark:border-pink-500 dark:bg-pink-600 dark:hover:border-pink-600 dark:hover:bg-pink-700 dark:focus:ring-pink-500' => $danger,
        'text-purple-600 underline decoration-transparent hover:decoration-purple-600 dark:text-purple-400 dark:hover:decoration-purple-400' => $link,
        'rounded-full w-7 h-7 justify-center' => $iconOnly,
        'rounded-md px-4 py-3 sm:py-2' => !$iconOnly,
    ];
@endphp

@if ($action)
    <form class="inline-block w-full" method="{{ $method !== 'post' ? 'post' : $method }}" action="{{ $action }}">
        @csrf

        @if ($method !== 'post')
            <input type="hidden" name="_method" value="{{ $method }}"/>
        @endif
        @endif

        @if ($href)
            <a
                x-data="{}"
                href="{{ $href }}"
                @click="{{ $clickHandler() }}"
                @class(array_merge($classes, [$attributes->get('class')]))
                {{ $attributes->except(['class', 'href']) }}
            >
                {{ $slot }}
            </a>
        @else
            <button
                x-data="{}"
                type="{{ $type }}"
                @click="{{ $clickHandler() }}"
                @class(array_merge($classes, [$attributes->get('class')]))
                {{ $attributes->except(['class', 'type']) }}
            >
                {{ $slot }}
            </button>
        @endif

        @if ($action)
    </form>
@endif
