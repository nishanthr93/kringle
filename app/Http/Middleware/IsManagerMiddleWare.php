<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Roles;
use Illuminate\Http\Request;

class IsManagerMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ((!auth()->check()) && !(auth()->user()->role_id == Roles::IS_MANAGER)) {
            abort(403);
        }
        return $next($request);
    }
}
