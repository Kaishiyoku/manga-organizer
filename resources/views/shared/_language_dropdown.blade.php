<span class="dropup">
    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-globe" aria-hidden="true"></i>

        {{ __('common.language') }}
    </a>
    <div class="dropdown-menu">
        @foreach (config('app.available_locales') as $locale)
            <a class="dropdown-item{{ Session::get('locale') == $locale ? ' active' : '' }}" href="{{ route('language.change') }}"
               onclick="event.preventDefault(); document.getElementById('lang-form-{{ $locale }}').submit();">
                {{ trans('common.languages.' . $locale) }}
            </a>

            {{ Form::open(['route' => 'language.change', 'method' => 'post', 'id' => 'lang-form-' . $locale, 'style' => 'display: none;']) }}
                {{ Form::hidden('locale', $locale) }}
            {{ Form::close() }}
        @endforeach
    </div>
</span>