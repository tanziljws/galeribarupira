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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'check.admin' => \App\Http\Middleware\CheckAdmin::class,
            'check.user' => \App\Http\Middleware\CheckUserAuth::class,
            'check.admin.only' => \App\Http\Middleware\CheckAdminAuth::class,
            'check.user.only' => \App\Http\Middleware\CheckUserOnly::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withProviders([
        App\Providers\AdminServiceProvider::class,
    ])->create();
