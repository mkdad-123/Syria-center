<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // api/console حسب وجودها...
    )
    ->withMiddleware(function (Middleware $middleware) {
        // خلّيه في بداية web عشان يشتغل قبل أي Blade
        $middleware->web(prepend: [
            \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(fn () => null)
    ->create();
