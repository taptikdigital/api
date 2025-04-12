<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Http\Middleware\CustomJwtAuthenticate;


use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->append(CustomJwtAuthenticate::class);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Catch authentication exceptions and return JSON.
        $exceptions->render(function (AuthenticationException $e, Request $request) {

            if ($request->expectsJson() || $request->is('api/*')) {
                
                $response = [
                    'status'      => false,
                    'status_code' => 401,
                    'message'     => 'Unauthenticated...'
                ];
        
                // if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException) {
                //     // Check if the exception message indicates that the token cannot be refreshed.
                //     if (strpos($e->getMessage(), 'can no longer be refreshed') !== false) {
                //         $response['message'] = 'Token has expired and can no longer be refreshed';
                //     } else {
                //         $response['message'] = 'Token has expired';
                //     }
                // } elseif ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException) {
                //     $response['message'] = 'Token is invalid';
                // } elseif ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException) {
                //     $response['message'] = 'Authorization token not found';
                // } elseif ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException) {
                //     $response['message'] = 'The token has been blacklisted';
                // }
        
                return response()->json($response, 401);
            }
            
        });
        
        
    })->create();
