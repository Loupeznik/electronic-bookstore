<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSuperuser
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
        if ($request->user()->role == 2) return $next($request);
        return redirect('/admin/dashboard')->with('status', 'error')->with('message', 'You do not have sufficient privileges to enter this section');
    }
}
