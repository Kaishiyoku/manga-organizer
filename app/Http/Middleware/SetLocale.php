<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Str;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = Str::substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        App::setLocale($locale);

        return $next($request);
    }
}
