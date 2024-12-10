<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //

        $middleware->appendToGroup(
            'web', [
                \App\Http\Middleware\Localization::class,
                \App\Http\Middleware\ClearNotification::class,
            ]);
        $middleware->alias([
            "clearNotification" => \App\Http\Middleware\ClearNotification::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
