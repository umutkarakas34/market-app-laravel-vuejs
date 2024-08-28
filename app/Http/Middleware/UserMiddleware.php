<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken || $accessToken->tokenable_type !== 'App\Models\User') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}
