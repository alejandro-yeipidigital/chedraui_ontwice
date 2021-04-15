<?php

namespace App\Traits;

use App\Models\Participation;
use App\Models\UserGame;
use Carbon\Carbon;

/**
* Trait destinado para manejo de archivos en todo el sistema
*/
trait GameTrait 
{
    /**
    * @return 
    */
    public function verifyIfThereAreGames($section = '')
    {
        // first we look if exist an active participation
        $user           = auth()->user();
        $participation  = Participation::whereUserId( $user->id )
                                    ->whereTemporalityId( $this->activeTemporality()->id )
                                    ->whereStatus(1)
                                    ->where('played_lifes', '<', 1)
                                    ->orderBy('id', 'desc')
                                    ->first();

        

        // no existen participaciones activas
        if ( $participation == null ) {

            if ( $section == "" ) {
                $participation  = Participation::whereUserId( $user->id )
                                        ->whereTemporalityId( $this->activeTemporality()->id )
                                        ->whereStatus(1)
                                        ->where('played_lifes', '=', 1)
                                        ->orderBy('id', 'desc')
                                        ->first();

                try {
                    //code...
                    $games = UserGame::whereParticipationId( $participation->id )->get();
    
                    if (count($games) > 0) {
                        // si hay un juego anterior con status diferente a terminado se considera que el usuario recargo
                        if ($games[ $participation->played_lifes - 1 ]->status == 1) {

                            $games[ $participation->played_lifes - 1 ]->update([
                                'status'        => 4,
                                'status_game'   => 'Browser reloaded'
                            ]);
                        }
                    }
                    Participation::whereId( $participation->id )->update([
                        'status' => 2
                    ]);
                } catch (\Throwable $th) {
                    \Log::info( $th );
                }


            }

            return false;
        }

        if ( $section == 'instructions' || $section == 'principal_game') {
            return true;
        }

        // en este punto existe una participacion y vidas suficientes para seguir jugando
        $games = UserGame::whereParticipationId( $participation->id )->get();

        if (count($games) > 0) {
            // si hay un juego anterior con status diferente a terminado se considera que el usuario recargo
            if ($games[$participation->played_lifes - 1]->status == 1) {

                $cDate          = Carbon::parse( $games[ $participation->played_lifes - 1]->created_at );
                $diffInSecconds = $cDate->diffInSeconds();

                if ($diffInSecconds > 15 && $games[$participation->played_lifes - 1]->life == 1 ) {
                    $games[ $participation->played_lifes - 1 ]->update([
                        'status'        => 3,
                        'status_game'   => 'Browser reloaded'
                    ]);
                } elseif( $diffInSecconds > 8 && $games[$participation->played_lifes - 1]->life > 1 ) {
                    $games[ $participation->played_lifes - 1 ]->update([
                        'status'        => 3,
                        'status_game'   => 'Browser reloaded'
                    ]);
                } else {
                    return true;
                }
            }
        }

        // si los juegos "jugados" son menores a 3
        if ( $participation->played_lifes < 1 ) {
            // creamos un nuevo juego para el usuario
            UserGame::create([
                "participation_id"  => $participation->id,
                "life"              => $participation->played_lifes + 1
            ]);
        }

        // update lifes in participations
        Participation::whereId( $participation->id )->update([
            'played_lifes' => $participation->played_lifes + 1
        ]);

        return $participation;
    }
}
