<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use App\Models\UserGame;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Traits\TemporalityTrait;
use App\Traits\GameTrait;
use Carbon\Carbon;

class GameController extends Controller
{
    use TemporalityTrait;
    use GameTrait;

    /**
    * @return 
    */
    public function __construct()
    {
        $this->middleware('auth:web');
        $this->middleware('verifyOnlyOneSession');
    }


    /**
    * @return 
    */
    public function instructions()
    {
        if ( !$this->verifyIfThereAreGames('instructions') ) {
            return redirect()->route('tickets.index');
        }

        // tiene ticket ingresado y una participacion pendiente de validacion?
        return view('public.game.instructions');
    }

    /**
    * @return 
    */
    public function game()
    {
        // tiene ticket y juego?
        if ( !$this->verifyIfThereAreGames() ) {
            return redirect()->route('tickets.index');
        }

        return view( "public.game.index");
    }

    /**
    * @return 
    */
    public function savePoints(Request $request)
    {
        // se recive la informacion para poderla guardar
        $score          = $request->input('score');

        $user               = Auth()->user();
        $temporality_id     = $this->activeTemporality()->id;
        $participation      = Participation::whereUserId( $user->id )
                                    ->whereTemporalityId( $this->activeTemporality()->id )
                                    ->whereStatus(1)
                                    ->where('played_lifes', '<=', 1)
                                    ->orderBy('id', 'desc')
                                    ->first();

        if ( $participation == null ) {
            return redirect()->route('tickets.index');
        }

        $games = UserGame::whereParticipationId( $participation->id )->get();

        if ( count( $games ) > 0 ) {
            // si hay un juego anterior con status diferente a terminado se considera que el usuario recargo
            $activeGame = $games[$participation->played_lifes - 1];

            if ( $activeGame->status == 1 ) {

                if ( $score > 300 ) {
                    $score = 300;
                }
                
                // almacenamos el score del usuario de esa vida
                $games[ $participation->played_lifes - 1 ]->update([
                    'status'        => 2,
                    'status_game'   => 'Game Finished',
                    'points'        => $score
                ]);

                // buscamos el userpoint general de esa temporalidad
                $user_point = UserPoint::whereTemporalityId( $this->activeTemporality()->id )
                                    ->whereUserId( $user->id )
                                    ->first();
                
                // Si la participación es de la vida inicial regalada
                if ($participation->free == 1) {
                    // actualizamos los puntos de validacion
                    UserPoint::whereId( $user_point->id )->update([
                        'validated_points' => $user_point->pending_points + $score
                    ]);
                }else{
                    // actualizamos los puntos pendientes de validacion
                    UserPoint::whereId( $user_point->id )->update([
                        'pending_points' => $user_point->pending_points + $score
                    ]);

                }

                // si ya hay 1 vidas jugadas solo queda cambiar el status de la participacion
                if ( $participation->played_lifes == 1 ) {

                    // cambiamos la participacion a finalizada
                    Participation::whereId( $participation->id )->update([
                        'total_points'  => $participation->total_points + $score,
                        'status'        => 2
                    ]);

                    // redireccionamos a el perfil de usuario
                    if ($participation->free == 1) {
                        return redirect()->route('users.profile')->with('status', [
                            'alert'    => true,
                            'status'    => 'success',
                            'message'   => 'Felicidades, acumulaste un total de '.($participation->total_points + $score).' puntos. Registra tus tickets para seguir participando.',
                            'juego_play' => true, 
                            'timestamp' => $participation->created_at
                        ]);
                    }else{
                        return redirect()->route('users.profile')->with('status', [
                            'alert'    => true,
                            'status'    => 'success',
                            'message'   => 'Felicidades, acumulaste un total de '.($participation->total_points + $score).' puntos. Los puntos acumulados se verán reflejados en tu perfil cuando se valide tu ticket.',
                            'juego_play' => true, 
                            'timestamp' => $participation->created_at
                        ]);
                    }

                } else {
                    // actualizamos unicamente los puntos obtenidos con la vida
                    Participation::whereId( $participation->id )->update([
                        'total_points' => $participation->total_points + $score
                    ]);

                    // redireccionamos con mensaje de puntos almacenados
                    return redirect()->route('game.play')->with('status',[
                        'status'    => 'success',
                        'message'   => 'Continua jugando para obtener mas puntos, Vidas restantes = '.( 3 - $participation->played_lifes )
                    ]);

                }
            }
        } 

        return redirect()->route('tickets.index');
    }
}
