<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\AuthenticationException;

class CustomJwtAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        // echo "id = ".$request->user_id;
        // dd($request->path());
        // dd($request->all());

        // Bypass token check for public routes like "login"
        if ($request->is('docs')) {
            return $next($request);
        }

        if ($request->is('api/v1/login')) {
            return $next($request);
        }

        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'success' => false,
                'status_code' => 422,
                'message' => 'Token not provided',
                'data' => [],
            ], 422);
        }

        if (!Auth::guard('api')->check()) {
            return response()->json([
                'success' => false,
                'status_code' => 401,
                'message' => 'Invalid or expired token',
                'data' => [],
            ], 401);
        }

        if(!$request['user_id'])
        {
            $user = Auth::guard('api')->user();
            $userId = $user->parentId ?? $user->id;

            $request->merge(['user_id' => $userId]);
        }
        return $next($request);


        
    }
}
