<?php

namespace App\Http\Middleware;

use Closure;

class RegisterComplete
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
        
        if ($user) {
            if ($user->fb_id && !isset($user->zip_code)) {
                // dd($user);
                return redirect('/completa-tu-registro');
            }
        }

        return $next($request);
    }
}
