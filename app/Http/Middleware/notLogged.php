<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class notLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('user')) {
            return redirect('/user/'.$request->session()->get('user')->id);
        }
        return $next($request);
    }
}
