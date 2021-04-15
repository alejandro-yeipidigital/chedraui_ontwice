<?php

namespace App\Http\Controllers\Auth;

use App\Mails\UserRegister;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Participation;
use App\Models\UserPoint;
use App\Traits\TemporalityTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    use TemporalityTrait;

    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider)
    {
        if($provider === "facebook"){
            return Socialite::driver($provider)->redirect();
        }else{
            return redirect(route('login'));
        }
    }

    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        try{
            $social_user = Socialite::driver($provider)->user();
        }catch(\Exception $e){
            return redirect(route('home'));
        }
        
        // Comprobamos si el usuario ya existe
        if ($user = User::where('email', $social_user->email)->first()) {
            return $this->authAndRedirect($user, $register = false); // Login y redirección
        } else {

            if($social_user->email){
                 // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = User::create([
                    'name' => $social_user->name,
                    'email' => $social_user->email,
                    'fb_email' => $social_user->email,
                    'avatar' => $social_user->avatar_original,
                    'active' => 1,
                    'register_type' => 'Facebook'
                ]);
                return $this->authAndRedirect($user, $register = true ); // Login y redirección
            }else{
                return redirect(route('login'))->with(['error_message' => 'fb_not_user']);
            }
           
        }
    }

    // Login y redirección
    public function authAndRedirect($user, $register)
    {
        Auth::login($user);


        // VIDA POR REGISTRO
        if($register){
            $activeTemp = $this->activeTemporality()->id;

            $ticket_data = Participation::create([
                'ticket'            => '',
                'ticket_code'       => 'free life',
                'validation'        => 2,
                'temporality_id'    => $activeTemp,
                'user_id'           => $user->id,
                'free'              => 1
            ]);

            // validate if user point with this temporality exists
            $user_point = UserPoint::whereTemporalityId( $activeTemp )
                                        ->whereUserId( $user->id )
                                        ->first();

            if ( $user_point == null ) {
                UserPoint::create([
                    'temporality_id'    => $activeTemp,
                    'user_id'           => $user->id,
                    'validated_points'  => 0,
                    'pending_points'    => 0,
                    'winner'            => 0
                ]);
            }

            auth()->user()->participations()->save($ticket_data);

            return redirect()->route('game.instructions')->with('status', [
                'status'    => 'success',
                'freeLife'  => true
            ]);
        }

        return redirect(route('users.profile'));
    }
}
