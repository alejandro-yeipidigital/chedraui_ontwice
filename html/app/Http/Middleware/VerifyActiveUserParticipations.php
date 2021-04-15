<?php

namespace App\Http\Middleware;

use App\Models\Participation;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyActiveUserParticipations
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
        $user               = Auth::user();
        $participations     = Participation::whereUserId( $user->id )
                                    ->whereStatus(1)
                                    ->get();

        if ( count($participations) > 0 ) {
            foreach ($participations as $key => $participation) {
                $participation->update(['status' => 3]);
            }
        }

        return $next($request);
    }
}
