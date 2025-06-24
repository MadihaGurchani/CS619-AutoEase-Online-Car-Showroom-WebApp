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
        //Register AdminRedirect Middleware ko aur alia banaya hai
        $middleware->alias([
            'admin.guest' => \App\Http\Middleware\AdminRedirect::class,
            'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,
        ]);

        $middleware->redirectTo(
            //Binna authenticate kiye agar guest mode main dashboard url access toh /account/login page per redirect
            guests: '/account/login',
            //Authenticated users jab dashboard access karein toh unhein allow kiya jaye
            users: '/account/dashboard',
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


