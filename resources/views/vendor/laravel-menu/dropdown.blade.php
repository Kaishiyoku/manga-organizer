<li class="nav-item dropdown">
    <a
        href="#"
        id="{{ $id }}"
        role="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        class="{{ classNames('nav-link dropdown-toggle', ['active' => $dropdownIsActiveFn()]) }}"
    >
        {!! $title !!}
    </a>
    <div aria-labelledby="{{ $id }}" class="dropdown-menu">
        @foreach ($entries as $entry)
            {!! $entry->render() !!}
        @endforeach
    </div>
</li>
