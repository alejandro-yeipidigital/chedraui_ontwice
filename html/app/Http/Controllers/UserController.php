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
        $this->middleware('verifyOnlyOneSession');
        $this->middleware('VerifyAbandonedActiveParticipation');
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
            'middle_name'   => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'telephone'     => ['required', 'regex:/[0-9]/'],
            'birthday'      => ['required', 'string'],
        ]);

        $auth_user = User::find(auth()->user()->id);
        $auth_user->update(
            $request->all()
        );
        return redirect(route('tickets.index'));
    }

    public function profile()
    {
        $auth_user = Auth::user();

        $name = $auth_user->name;
        $middle_name = $auth_user->middle_name;
        $last_name = $auth_user->last_name;
        $userAvatar = $auth_user->avatar;
        $uploadedTickets = false;

        Session::put('userAvatar', $userAvatar);

        $actualTemporality  = $this->activeTemporality()->id;

        $user_points = UserPoint::select('validated_points')
        ->whereUserId($auth_user->id)
        ->whereTemporalityId($actualTemporality)
        ->first();

        if ($user_points) {
            $tickets_validated = Participation::whereUserId($auth_user->id)->whereTemporalityId($actualTemporality)->whereFree(0)->count();

            $user_position = UserPoint::where('validated_points', '>', $user_points->validated_points)
                        ->whereTemporalityId($actualTemporality)
                        ->orderBy('validated_points', 'desc')
                        ->count();
            $user_position++;
            $uploadedTickets = true;
            $tickets = Participation::whereUserId($auth_user->id)->whereFree(0)->get();
        }else{
            $user_position=0;
            $user_points=0;
            $tickets_validated=0;
            $tickets=0;    
        }      
           
        return view('public.user.profile', compact('name', 'middle_name', 'last_name', 'userAvatar', 'user_points', 'user_position', 'actualTemporality', 'tickets_validated', 'tickets', 'uploadedTickets'));
    }

}
