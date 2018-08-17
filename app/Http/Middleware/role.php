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
        $role = null;
        $user = JWTAuth::toUser($request->token);
        $permission_level = $user->permission;
        if ($permission_level == 1) {
            $role = "admin";
        }
        if ($permission_level == 2) {
            $role = "account_manager";
        }
        if ($permission_level == 3) {
            $role = "bdm";
        }
        if (RoleController::hasAccess($role)) {
            return $next($request);
        }
        return response()->json(['Access Denied'], 400);
    }
}
