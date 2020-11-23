<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles)
    {
        if(in_array($request->user()->roles,$roles)) {
            return $next($request);
        }else {
            return App::abort(Auth::check() ? 403 : 401 ,
            Auth::check() ? 'Forbidden' : 'Unauthorized');
        }
    }
}
