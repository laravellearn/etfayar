<?php

namespace App\Http\Middleware;

use App\Models\IP;
use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PermissionMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $permission) {
        //$user = $request->user('admin');
        // Artisan::call('migrate');
        //dd($request->ip(), $request->ips(), $request->getClientIp());

        try {
            $permission = Permission::query()->where('title', $permission)->first();
            //dd($permission,auth()->guard('admin')->user()->hasPermission($permission));
            if (!auth()->guard('admin')->user() || !auth()->guard('admin')->user()->hasPermission($permission)) {
                //abort(403);
                return response()->redirectTo('admin/login');
            }
        } catch (\Exception $e) {
            //abort(403);
            return response()->redirectTo('admin/login');
        }
        return $next($request);
    }
}
