@props(['href', 'active' => false])

<a href="{{ $href }}" class="{{ classNames('text-purple-600 dark:text-purple-400 border-b-2 border-transparent hover:border-purple-200 dark:hover:border-purple-800 transition', ['border-purple-300 dark:border-purple-700' => $active]) }}">
    {{ $slot }}
</a>
