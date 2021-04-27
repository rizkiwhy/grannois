<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roleIds)
    {
        if (in_array($request->user()->role_id, $roleIds)) {
            return $next($request);
        } else {
            return redirect()
                ->route('login.view')
                ->with('error_message', 'Anda tidak memiliki hak akses!');
        }
    }
}
