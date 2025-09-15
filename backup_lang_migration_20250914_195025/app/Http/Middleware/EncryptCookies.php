<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    // اسماء الكوكيز غير المشفّرة
    protected $except = [
        'lang',
    ];
}
