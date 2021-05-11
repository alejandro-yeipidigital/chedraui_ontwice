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
            'name'          => ['required', 'string', 'max:255'],
            'middle_name'   => ['required', 'string'],
            'last_name'     => ['required', 'string'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthday'      => ['required', 'date'],
            'street'        => ['required', 'string'],
            'municipality'  => ['required', 'string'],
            'zip_code'      => ['required', 'string'],
            'state'         => ['required', 'string'],
            'password'      => ['required', 'string', 'min:8', 'confirmed']
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
            'name'          => $data['name'],
            'email'         => $data['email'],
            'middle_name'   => $data['middle_name'],
            'last_name'     => $data['last_name'],
            'birthday'      => $data['birthday'],
            'street'        => $data['street'],
            'municipality'  => $data['municipality'],
            'zip_code'      => $data['zip_code'],
            'state'         => $data['state'],
            'password'      => Hash::make($data['password']),
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
        return redirect($this->redirectTo);
    }
}
