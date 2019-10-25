<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Models\AuthAssignment;
use App\Http\Traits\ApiResponse;

use Closure;
use JWTAuth;

class Permission
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->header('Authorization') && JWTAuth::parseToken()->authenticate();

        if (!AuthAssignment::hasAccess()) {
            if (cuser()) {
                throw new AuthorizationException;
            } else {
                $currentRoute = \Route::current();
                if($request->is('api/*')) {
                    return $this->jsonOut([
                        'message' => trans('auth.login_required'),
                        'statusCode' => 401,
                    ]);
                }

                return redirect('login');
            }
        }

        return $next($request);
    }
}
