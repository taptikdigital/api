<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Providers\Auth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



/**
 * @group Authenticate
 *
 * APIs for managing all user's authentication related like login, refresh & logout
 */



class AuthController extends Controller
{


    /**
     * login
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `422` error.
     * 
     *
     *
     * <aside class="notice">basepath/api/v1/login</aside>
     * @method POST
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "token_created_at": "11-04-2025 22:26:56",
            "access_token": "eyJ0ekrjkgkdgjdfg9g.....",
            "token_type": "bearer",
            "expires_in": 3600,
            "refresh_expires_in": 1209600,
            "user": {
                "id": 1,
                "name": "Test User",
                "email": "test@taptik.in",
                "mobile": "9876543212",
                "parentId": null,
                "email_verify_at": null,
                "mobile_verify_at": null,
                "subscription_id": 2,
                "free_plan_expire_at": "2025-03-15",
                "subscription": {
                    "id": 2,
                    "name": "Basic",
                    "slug": "basic"
                },
                "user_active_subscription": null
            },
            "subscription": {
                "id": 2,
                "name": "Basic",
                "slug": "basic"
            },
            "activePlan": null
        }
     *
     * @response 200
     *  {
            "token_created_at": "11-04-2025 22:28:25",
            "access_token": "eyJyrtutyuPU......",
            "token_type": "bearer",
            "expires_in": 3600,
            "refresh_expires_in": 1209600,
            "user": {
                "id": 1,
                "name": "Test User",
                "email": "test@taptik.in",
                "mobile": "9876543212",
                "parentId": null,
                "email_verify_at": null,
                "mobile_verify_at": null,
                "subscription_id": 2,
                "free_plan_expire_at": "2025-03-15",
                "subscription": {
                    "id": 2,
                    "name": "Basic",
                    "slug": "basic"
                },
                "user_active_subscription": {
                    "id": 5,
                    "subscription_status": "active",
                    "next_payment_date": null,
                    "created_at": "16-Mar-2025 06:45:11 AM"
                }
            },
            "subscription": {
                "id": 2,
                "name": "Basic",
                "slug": "basic"
            },
            "activePlan": {
                "id": 5,
                "subscription_status": "active",
                "next_payment_date": null,
                "created_at": "16-Mar-2025 06:45:11 AM"
            }
        }
     *
     *
     * @response 422
     *  {
            "email": [
                "The email field is required."
            ],
            "password": [
                "The password field is required."
            ]
        }
     * 
     *
     */
    
    
     
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }




    /**
     * refresh
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `422` and `500` error.
     * 
     *
     *
     * <aside class="notice">basepath/api/v1/refresh</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "token_created_at": "11-04-2025 22:28:25",
            "access_token": "eyJyrtutyuPU......",
            "token_type": "bearer",
            "expires_in": 3600,
            "refresh_expires_in": 1209600,
            "user": {
                "id": 1,
                "name": "Test User",
                "email": "test@taptik.in",
                "mobile": "9876543212",
                "parentId": null,
                "email_verify_at": null,
                "mobile_verify_at": null,
                "subscription_id": 2,
                "free_plan_expire_at": "2025-03-15",
                "subscription": {
                    "id": 2,
                    "name": "Basic",
                    "slug": "basic"
                },
                "user_active_subscription": {
                    "id": 5,
                    "subscription_status": "active",
                    "next_payment_date": null,
                    "created_at": "16-Mar-2025 06:45:11 AM"
                }
            },
            "subscription": {
                "id": 2,
                "name": "Basic",
                "slug": "basic"
            },
            "activePlan": {
                "id": 5,
                "subscription_status": "active",
                "next_payment_date": null,
                "created_at": "16-Mar-2025 06:45:11 AM"
            }
        }
     *
     *
     * @response 422
     *  {
            "error": "Token not provided"
        }
     * 
     *
     * @response 500
     *  {
            "message": "Could not decode token: Error while decoding from Base64Url, invalid base64 characters detected",
            "exception": "PHPOpenSourceSaver\\JWTAuth\\Exceptions\\TokenInvalidException",
        }
     * 
     *
     */
    
    // Refresh token endpoint: call this when the client needs a new token.
    public function  refresh(Request $request)
    {
        // Retrieve token from the Authorization header
        $token = $request->bearerToken();

        // Validate that the token is provided
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 422);
        }

        try {
            $newToken = auth()->refresh();
            return $this->createNewToken($newToken);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not refresh token'], 401);
        }
    }

    protected function createNewToken($token)
    {
        $accessTTL          = auth('api')->factory()->getTTL(); // in minutes
        $refreshTTL         = config('jwt.refresh_ttl'); // in minutes
        return response()->json([
            'token_created_at' => date('d-m-Y H:i:s'),
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => $accessTTL * 60,
            'refresh_expires_in' => $refreshTTL * 60,
            'user'          => auth('api')->user(),
            'subscription'  => auth('api')->user()->subscription,
            'activePlan'    => auth('api')->user()->userActiveSubscription,
        ]);
    }



    /**
     * logout
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `401` and `500` error,
     * 
     *
     *
     * <aside class="notice">basepath/api/v1/logout</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "message": "User successfully signed out"
        }
     *
     *
     * @response 401
     *  {
            "status": false,
            "status_code": 401,
            "message": "Unauthenticated..."
        }
     *
     *
     * @response 500
     *  {
            "message": "Could not decode token: Error while decoding from Base64Url, invalid base64 characters detected",
            "exception": "PHPOpenSourceSaver\\JWTAuth\\Exceptions\\TokenInvalidException",
        }
     * 
     *
     */

    public function logout(Request $request)
    {

        // Retrieve token from the Authorization header
        $token = $request->bearerToken();

        // Validate that the token is provided
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 422);
        }

        auth('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    
}
