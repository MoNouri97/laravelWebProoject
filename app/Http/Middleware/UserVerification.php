<?php

namespace App\Http\Middleware;

use Closure;
/**
 * verify that a user can only change his own profile
 */
class UserVerification
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
        if(auth()->user()->type == 'admin') {
            // valid user
            return $next($request);
       } else {
           if (auth()->user()->id == $request->route('user') ) {
                return $next($request);
           }
            //not allowed
            return redirect('/posts')->with('error','You don\'t have the right to perform this action');
       }
        
    }
}
