<?php

namespace System\Http\Middleware;

use Closure;

class CheckLoginRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = $request->user();


        //if is user logged and user_type is Admin
        if ($user && $user->hasAnyRole($role))
        {
            return $next($request);
        }

        return redirect('/');
    }
}
