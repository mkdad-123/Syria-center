<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // تحديد اللغة بناءً على لغة المتصفح
            $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            App::setLocale(in_array($browserLang, ['ar', 'en']) ? $browserLang : 'ar');
        }

        return $next($request);
    }
}