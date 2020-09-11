<div class="relative navbar-link cursor-pointer select-none" data-provide-dropdown data-dropdown-target="#language-dropdown">
    <a>
        {{ __('common.language') }}

        <i class="fas fa-caret-down mt-1"></i>
    </a>

    <div id="language-dropdown" class="hidden rounded-md shadow-xl">
        <div class="dropdown">
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                @foreach (config('app.available_locales') as $locale)
                    <a
                        id="lang-link-{{ $locale }}"
                        class="dropdown-item {{ (Session::get('locale') === $locale ? ' dropdown-item-active' : '') }}"
                    >
                        <div class="flex">
                            <img class="w-6 mr-2" src="{{ asset('/img/flags/' . $locale . '.svg') }}" alt="{{ $locale }}">
                            <div>{{ __('common.languages.' . $locale) }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
