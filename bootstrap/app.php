<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(_DIR_))
    ->withRouting(
        web: _DIR_.'/../routes/web.php',
        commands: _DIR_.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\TrustProxies::class);
        $middleware->append(\App\Http\Middleware\ForceHttps::class); // Pastikan ForceHttps juga ada
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
