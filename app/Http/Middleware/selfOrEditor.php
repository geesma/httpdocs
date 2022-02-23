<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class selfOrEditor
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
        $role = $request->session()->get('user')->role;
        $user = $request->id;
        if($role != 'super' && $role != 'editor' && $request->session()->get('user')->id != $user) {
            return redirect('/user/'.$request->session()->get('user')->id);
        }
        return $next($request);
    }
}
