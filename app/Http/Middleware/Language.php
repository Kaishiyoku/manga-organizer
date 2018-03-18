<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Krucas\Notification\Facades\Notification;

class Language
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('locale')) {
            // Try to set locale by browser language
            $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            if (in_array($browserLang, (array) config('app.available_locales'))) {
                Session::put('locale', $browserLang);
            } else {
                Session::put('locale', Config::get('app.locale'));
            }
        }

        // if logged in set user locale stored in database
        if ($this->auth->check()) {
            Session::put('locale', $this->auth->user()->locale);
        }

        app()->setLocale(Session::get('locale'));
        Carbon::setLocale(Session::get('locale'));

        return $next($request);
    }
}
