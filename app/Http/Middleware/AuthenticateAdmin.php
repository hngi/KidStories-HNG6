<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAdmin
{
    /**
     * Guard 
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Handle an incoming request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->guard($this->guard)->check()) {
            return redirect(route('admin.login'));
        }

        return $next($request);
    }
}
