<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureAdmin;
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
            'admin' => EnsureAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (AuthenticationException $e, Request $request) {
            $message = 'يجب تسجيل الدخول أولاً لاختيار الهدية أو إضافتها إلى السلة.';
            if ($request->expectsJson()) {
                $loginUrl = route('login') . '?login_required=1';
                return response()->json([
                    'message' => $message,
                    'redirect' => $loginUrl,
                ], 401);
            }
            return redirect()->guest(route('login'))
                ->with('login_required', $message);
        });
    })->create();
