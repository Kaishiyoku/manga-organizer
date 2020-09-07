<div class="relative navbar-link cursor-pointer" data-toggle="dropdown" data-target="#language-dropdown">
    <a id="test">
        {{ __('common.language') }}

        <i class="fas fa-caret-down mt-1"></i>
    </a>

    <div id="language-dropdown" class="hidden absolute mt-3 rounded-md shadow-xl">
        <div class="rounded-md bg-white shadow-xs">
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                @foreach (config('app.available_locales') as $locale)
                    <a
                        href="#"
                        id="lang-link-{{ $locale }}"
                        class="block px-4 py-2 leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900{{ (Session::get('locale') == $locale ? ' bg-gray-200' : '') }}"
                    >
                        {{ __('common.languages.' . $locale) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
