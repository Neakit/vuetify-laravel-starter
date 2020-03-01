<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleAuth
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
        $user = Auth::user();

        if($request->is('admin/dashboard')) {
            if ((empty($user) || $user->role !== 100) && !($request->ajax())) {
                return $next($request);
            } else {
                return redirect('admin/dashboard');
            }
        }

        if (empty($user) || $user->role !== 100) {
            if($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->back();
            }
        }

        return $next($request);
    }
}
