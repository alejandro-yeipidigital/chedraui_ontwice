<?php

namespace App\Http\Middleware;

use App\Models\Participation;
use App\Models\UserGame;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyAbandonedActiveParticipation
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
        try {
            $user               = Auth::user();
            $participations     = Participation::whereUserId( $user->id )
                                        ->whereStatus(1)
                                        ->get();

            if ( count( $participations ) > 0 ) {
                foreach ($participations as $key => $participation) {

                    Participation::whereId( $participation->id )->update(['status' => 3]);

                    // se hace busqueda de los juegos que quedaron pendientes 
                    // y que practicamente se dejan abandonados igualmente
                    $userGames = UserGame::whereParticipationId( $participation->id )->whereStatus(1)->get();

                    foreach ($userGames as $key => $userGame) {

                        UserGame::whereId( $userGame->id )->update([
                            'status'        => 4,
                            'status_game'   => 'Game Abandoned'
                        ]);

                    }
                }
            }
        } catch (\Throwable $th) {
            \Log::info( $th );
        }
                
        return $next($request);
    }
}
