<?php
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AdminRedirectIfAuthenticated;
use App\Http\Middleware\LogVisitor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\UserMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            [
                'admin.guest' => AdminRedirectIfAuthenticated::class,
                'admin.auth' => AdminMiddleware::class,
                'auth.user' => UserMiddleware::class,
                'log.visitor' => LogVisitor::class,
            ]
        );
         
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();