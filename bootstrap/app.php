<?php

// Remove PHP version header
header_remove('X-Powered-By');

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
        $middleware->alias([
            'Admin' => \App\Http\Middleware\AdminMiddleware::class,
            'Employee' => \App\Http\Middleware\EmployeeMiddleware::class,
            'approved' => \App\Http\Middleware\EnsureUserIsApproved::class,
            'tech_inspector.readonly' => \App\Http\Middleware\DenyWriteAccessForTechInspector::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\SecurityHeaders::class,
        ]);

        $middleware->api(append: [
            \App\Http\Middleware\SecurityHeaders::class,
        ]);

        // Add global middleware for ALL responses
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
