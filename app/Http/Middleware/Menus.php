<?php

namespace App\Http\Middleware;

use Closure;
use Html;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Kaishiyoku\Menu\Config\Config;
use Kaishiyoku\Menu\Facades\Menu;

class Menus
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Kaishiyoku\Menu\Facades\MenuExistsException
     */
    public function handle($request, Closure $next)
    {
        $locales = collect(config('app.available_locales'));
        $envLinks = empty(env('SOCIAL_LINKS')) ? [] : explode(';', env('SOCIAL_LINKS'));

        $socialLinks = array_map(function ($entry) {
            $args = explode(',', $entry);

            return Menu::link($args[0], $args[1]);
        }, $envLinks);

        Menu::setConfig(Config::forBootstrap4());

        Menu::registerDefault([
            Menu::linkRoute('mangas.index', __('common.manga_list')),
            Menu::linkRoute('mangas.index_plain', __('common.list_as_text')),
            Menu::linkRoute('mangas.statistics', __('common.statistics')),
            Menu::linkRoute('recommendations.create', __('common.recommend_manga')),
            Menu::linkRoute('mangas.manage', __('common.manage_mangas'), [], [], [], $this->auth->check())
        ], ['class' => 'nav navbar-nav']);

        Menu::register('right', [
            Menu::dropdown($socialLinks, __('common.social'), null, [], [], count($socialLinks)),
            Menu::dropdown($locales->map(function ($locale) {
                return Menu::content(Html::link('#', __('common.languages.' . $locale), [
                    'class' => 'dropdown-item' . (Session::get('locale') == $locale ? ' active' : ''),
                    'id' => 'lang-link-' . $locale
                ]));
            }), __('common.language'))
        ], ['class' => 'nav navbar-nav']);

        return $next($request);
    }
}