@props(['href', 'active' => false])

<a
    href="{{ $href }}"
    @class(['text-purple-600 dark:text-purple-400 underline transition decoration-transparent hover:decoration-purple-600 dark:hover:decoration-purple-400', '' => $active])
>
    {{ $slot }}
</a>
