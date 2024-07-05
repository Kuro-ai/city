<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminUserMiddleware;
use App\Http\Middleware\CustomerUserMiddleware;
use App\Http\Middleware\ManagerUserMiddleware;
use App\Http\Middleware\StaffUserMiddleware;
use App\Http\Middleware\CashierUserMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'useradmin' => AdminUserMiddleware::class,
            'usermanager' => ManagerUserMiddleware::class,
            'userstaff' => StaffUserMiddleware::class,
            'usercashier' => CashierUserMiddleware::class,
            'usercustomer' => CustomerUserMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
