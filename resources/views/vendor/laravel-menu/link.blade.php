<a
    href="{{ route($route) }}"
    class="{{ classNames('navbar-link', ['navbar-link-active' => $isActive]) }}"
>
    {!! $title ?? route($route) !!}
</a>
