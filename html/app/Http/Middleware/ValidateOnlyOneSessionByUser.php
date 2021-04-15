<?php

namespace App\Http\Middleware;

use App\Models\Sessiones;
use Closure;

use Illuminate\Support\Facades\Auth;

class ValidateOnlyOneSessionByUser
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
        $user       = Auth::user();
        $cookie     = \Request::cookie( 'laravel_session' );
        $sessions   = Sessiones::whereUserId( $user->id )->where("id", "!=", $cookie)->get();

        foreach ($sessions as $key => $session) {
            $session->delete();
        }

        return $next($request);
    }
}
