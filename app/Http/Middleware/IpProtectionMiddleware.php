<?php

namespace App\Http\Middleware;

use App\Models\IP;
use App\Models\Permission;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

class IpProtectionMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {


        $is_active_ip_protection = Setting::getValue('is_active_ip_protection');
        if ($is_active_ip_protection == "true") {
            $current_ip = $request->ip();
            $ip = IP::query()
                ->where('address', $current_ip)
                ->where('status', 'valid')
                ->first();

            if (is_null($ip)) {
                return response()->redirectTo('admin/invalid');
            }
        };

        return $next($request);
    }
}
