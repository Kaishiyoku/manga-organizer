<?php

namespace App\Http\Middleware;

use Closure;
use Html;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Kaishiyoku\LaravelMenu\DropdownContainer;
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
     */
    public function handle($request, Closure $next)
    {
        \LaravelMenu::register()
            ->link('mangas.index', __('common.manga_list'), true)
            ->link('mangas.statistics', __('common.statistics'), true)
            ->linkIf($this->auth->guest(), 'recommendations.create', __('common.recommend_manga'), true)
            ->linkIf($this->auth->check(), 'mangas.manage,mangas.create,mangas.edit', __('common.manage_mangas'), true);

        return $next($request);
    }
}
