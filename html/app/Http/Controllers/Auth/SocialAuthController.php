<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Exception;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public $redirect_when_logged_in = '/perfil';
    private static $provider = 'facebook';

    /**
     * Handles solicite redirect, this is
     * the first method called
     * 
     * @param none
     * @return handleProviderCallback
     */
    public function redirectToFacebookProvider ()
    {
        return Socialite::driver(self::$provider)->redirect();
    }

    /**
     * Obtain user from provider and 
     * login if user already exists or create a new user
     * 
     * @param none
     * @return Redirect
     */
    public function handleFacebookCallback ()
    {
        info('Entra');
        // Obtain facebook user data
        try {
            $user   = Socialite::driver(self::$provider)->user();
        } catch (Exception $e) {
            info('Entra aqui');
            info($e);
            return redirect(route('home'));
        }

        // Verify if user exists, if true then login
        // else create a new user
        try {
            $isUser = User::whereFbId($user->id)->first();

            if ($isUser) {
                return $this->authAndRedirect($isUser, false);
            } else {
                $new_user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'profile_photo_path' => $user->avatar_original,
                    'password' => bcrypt('admin@123'),
                    'active' => 1
                ]);
    
                return $this->authAndRedirect($new_user, true);
            }
    
        } catch (Exception $e) {
            info("Error Facebook Login");
            info($e->getMessage());
            return redirect(route('login'))->with(['error_message' => 'fb_not_user']);
        }
    }

    /**
     * Redirect user when logged in
     * 
     * @param User $user
     * @return Redirect
     */
    public function authAndRedirect(User $user, bool $is_register)
    {
        // Authenticate with user
        Auth::login($user);

        # Add anyother logic required when user has been registerd for the first time
        // if ($is_register) {
            # code...
        // }

        return redirect($this->redirect_when_logged_in);
    }
}