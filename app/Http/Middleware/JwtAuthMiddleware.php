<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {

            JWTAuth::parseToken()->authenticate();

        } catch (Exception $e) {

            if ($e instanceof TokenInvalidException){

                return response()->json(['status' => 'Token is Invalid']);

            } else if ($e instanceof TokenExpiredException)  {

                return response()->json(['status' => 'Token is Expired']);

            } else {

                return response()->json(['status' => 'Authorization Token not found']);

            }
        }

        return $next($request);
    }
}
