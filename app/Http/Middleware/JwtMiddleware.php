<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Http\Models\User;

class JwtMiddleware extends BaseMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		try {
			User::$info = JWTAuth::parseToken()->authenticate();
		} catch (Exception $e) {
			if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
				$message = 'Token is Invalid';
			} else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
				$message = 'Token is Expired';
			} else {
				$message = 'Authorization Token not found';
			}

			return response()->json([
				'success' => false,
				'message' => $message
			], 401);
		}

		return $next($request);
	}
}
