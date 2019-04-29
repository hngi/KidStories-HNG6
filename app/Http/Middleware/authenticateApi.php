<?php

namespace App\Http\Middleware;

use Closure;

class authenticateApi
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
        if (!auth()->check()) {
            return response()->json([
                'status' => 'unauthorized',
                'code' => 401,
                'message' => 'user not logged in', 
            ],401);        
        }

        return $next($request);
    }
}
