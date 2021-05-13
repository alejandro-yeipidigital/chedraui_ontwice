<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use App\Models\UserPoint;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Traits\TemporalityTrait;

class UserController extends Controller
{
    use TemporalityTrait;

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
     # code
    }

    public function edit()
    {
        $user = Auth::user();
        return view('public.user.register', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'middle_name'   => ['required', 'string'],
            'last_name'     => ['required', 'string'],
            'email'         => ['required','string', 'email', 'max:255',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'birthday'      => ['required', 'date'],
            'telephone'     => ['required', 'string', 'min:10', 'max:10'],
            'street'        => ['required', 'string'],
            'municipality'  => ['required', 'string'],
            'zip_code'      => ['required', 'string'],
            'state'         => ['required', 'string']
        ]);

        $auth_user = User::find(auth()->user()->id);
        $auth_user->update(
            $request->all()
        );
        return redirect(route('tickets.index'));
    }

    public function profile()
    {
        $user = Auth::user();

        $name           = $user->name;
        $middle_name    = $user->middle_name;
        $last_name      = $user->last_name;
        $userAvatar     = $user->profile_photo_path;
        $uploadedTickets = false;

        Session::put('userAvatar', $userAvatar);

        // Get current temporality
        $actualTemporality  = $this->activeTemporality();

        $tickets = Participation::whereUserId($user->id)
                            ->whereTemporalityId($actualTemporality->id)
                            ->first();

        $user_points = UserPoint::whereUserId($user->id)
                                ->whereTemporalityId($actualTemporality->id)
                                ->first();

        // Default values
        $user_position      = 0;
        $user_points        = $user_points->points ?? 0;
        $tickets_validated  = 0;

        // If user has points, then update default values
        if ($tickets) {
            // dd('si');
            $tickets_validated = Participation::whereUserId($user->id)
                                                ->whereTemporalityId($actualTemporality->id)
                                                ->count();

            $user_position = UserPoint::where('points', '>', $user_points)
                                        ->whereTemporalityId($actualTemporality->id)
                                        ->orderBy('points', 'desc')
                                        ->count();

            $user_position++;

            $uploadedTickets = true;
            
            $tickets = Participation::whereUserId($user->id)->get();
        }      
           
        return view('public.user.profile', compact(
                                                    'user', 
                                                    'user_points', 
                                                    'user_position', 
                                                    'actualTemporality', 
                                                    'tickets_validated', 
                                                    'tickets', 
                                                    'uploadedTickets'
                                                ));
    }

}
