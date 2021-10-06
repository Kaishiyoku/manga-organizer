@props(['href', 'active' => false])

<a href="{{ $href }}" class="{{ classNames('text-purple-600 border-b-2 border-transparent hover:border-purple-200 transition', ['border-purple-300' => $active]) }}">
    {{ $slot }}
</a>
