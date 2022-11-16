@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'bg-purple-500/30 dark:bg-purple-500/40 text-purple-500 dark:text-purple-300 px-3 py-2 rounded-md text-sm transition'
                : 'text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 dark:hover:text-white px-3 py-2 rounded-md text-sm transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
