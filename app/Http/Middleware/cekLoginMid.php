<?php

namespace App\Http\Middleware;

use Closure;

class cekLoginMid
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
        if(!session('is_logon')){
            return redirect('/');
        }
        return $next($request);
    }
}
