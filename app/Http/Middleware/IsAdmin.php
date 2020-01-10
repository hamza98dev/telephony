<?php

namespace App\Http\Middleware;
use Auth;
use App\User;
use Closure;

class IsAdmin
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
     if (Auth::check()) {
        if( Auth::user()->is_admin==1)
        {
            return $next($request);
          
     //or redirect to somewhere
        }
    
        return abort(404);
       
     }
       
      
    }
}
