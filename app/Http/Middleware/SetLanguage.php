<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App;
use Session;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $lang = Session::get('lang', 'en');
        App::setLocale($lang);
        return $next($request);
    }
}
