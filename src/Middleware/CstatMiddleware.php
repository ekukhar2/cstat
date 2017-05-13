<?php

namespace App\Http\Middleware;

use Closure;
use Eugen\Cstat\Cstat;
class CstatMiddleware
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
        $cstat=new Cstat();
        return $next($request);
    }
}
