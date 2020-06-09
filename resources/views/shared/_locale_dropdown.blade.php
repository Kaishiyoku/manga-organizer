<a class="nav-link dropdown-toggle" href="#" id="navbarLocaleDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ __('common.language') }}
</a>

<div class="dropdown-menu" aria-labelledby="navbarLocaleDropdown">
    @foreach (config('app.available_locales') as $locale)
        <a href="#" class="dropdown-item {{ (Session::get('locale') == $locale ? ' active' : '') }}" id="lang-link-{{ $locale }}">
        {{ __('common.languages.' . $locale) }}
        </a>
    @endforeach
</div>
