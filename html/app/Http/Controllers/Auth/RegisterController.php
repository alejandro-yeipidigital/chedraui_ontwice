<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Participation;
use App\Models\UserPoint;
use App\Providers\RouteServiceProvider;
use App\Traits\TemporalityTrait;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use TemporalityTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        // REGISTRAR TICKET
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
}
