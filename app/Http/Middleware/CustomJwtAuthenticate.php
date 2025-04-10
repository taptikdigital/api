<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\AuthenticationException;

class CustomJwtAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        echo "before try ";
        die();

        try {

            echo "try";
            die();

            if (! auth('api')->check()) {
                throw new AuthenticationException('Unauthenticated.');
            }
            return $next($request);
        } catch (TokenExpiredException $e) {
            echo "catch";
            return response()->json(['message' => 'Token has expired and can no longer be refreshed....'], 401);
        } catch (TokenInvalidException $e) {
            echo "catch 2";
            return response()->json(['message' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            echo "catch 3";
            return response()->json(['message' => 'Authorization token not found'], 401);
        } catch (AuthenticationException $e) {
            echo "catch 4";
            return response()->json(['message' => $e->getMessage() ?: 'Unauthenticated.'], 401);
        }
    }
}
