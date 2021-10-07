@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block pl-3 pr-4 py-2 border-l-4 border-purple-400 text-base font-medium text-purple-700 dark:text-purple-200 bg-purple-50 dark:bg-purple-500 focus:outline-none focus:text-purple-800 focus:bg-purple-100 focus:border-purple-700 transition'
                : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
