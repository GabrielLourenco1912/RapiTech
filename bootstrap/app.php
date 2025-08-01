<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guest' => \App\Http\Middleware\RedirectIfAuthenticatedBasedOnRole::class,
            'auth' => \App\Http\Middleware\CustomAuthenticate::class,
            'checkrole' => \App\Http\Middleware\CheckRole::class,
        ]);

        $middleware->redirectUsersTo(function (Request $request) {
            return redirect()->guest(route('welcome'));
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
