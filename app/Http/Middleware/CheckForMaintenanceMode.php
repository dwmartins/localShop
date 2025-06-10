<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckForMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(config('settings.maintenance') === "on") {
            // if(auth()->check()) {
            //     $user = auth()->user();

            //     if($user->account_status && in_array($user->role, config('constants.has_access_app'))) {
            //         return $next($request); 
            //     }
            // }

            if($request->is('app*') || $request->is('logout')) {
                return $next($request);
            }

            return response()->view('pages.maintenance');
        }

        return $next($request);
    }
}
