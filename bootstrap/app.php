<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Models\Role;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // return $middleware->web(
            // append: \Spatie\Permission\Middlewares\RoleMiddleware::class
            // $middleware->alias('role' => \Spatie\Permission\Middleware\RoleMiddleware::class);
            // $middleware->alias('role', \Spatie\Permission\Middlewares\RoleMiddleware::class);
            // );
            $middleware->alias([
                'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
                'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
                'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
                'can' => \Illuminate\Auth\Middleware\Authorize::class, //tambahan
            ]);

            // $middleware->appendToGroup([
            //     'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            //     'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            //     'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            // ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
