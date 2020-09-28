<?php

namespace App\Http\Middleware;

use Closure;

class RoutineMiddleware
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
        if ($request->id != 1){
            return redirect('/profile');
        }
        return $next($request);
    }
}
