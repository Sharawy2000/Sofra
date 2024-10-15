<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'change-lang'=>'App\Http\Middleware\ChangeLang',
            'auto-check-permission'=>'App\Http\Middleware\AutoCheckPermission',
            'is-client'=>'App\Http\Middleware\IsClient',
            'is-restaurant'=>'App\Http\Middleware\IsRestaurant',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
