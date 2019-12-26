<?php

namespace App\Http\Middleware;

use Closure;

class WriterOrNot
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
        $user = auth()->user();
        if ($user->type == 'writer' || $user->type == 'admin') {
            return $next($request);
        }
        return redirect('/posts')->with('error','Doesn\'t have the right to write posts');
        
    }
}
