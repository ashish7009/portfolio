<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Http\Controllers\RoleController;

class role
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
        $user = JWTAuth::toUser($request->token);
        $permission_level = $user->permission;
        if ($permission_level == 1) {
            $role = "admin";
        }
        if ($permission_level == 2) {
            $role = "account_manager";
        }
        if (RoleController::hasAccess($role)) {
            return "access_denied";
        }
        return $next($request);
    }
}
