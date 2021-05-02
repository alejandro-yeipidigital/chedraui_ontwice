<?php

namespace App\Http\Controllers;

use App\Models\Temporality;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use App\Traits\TemporalityTrait;
use App\User;


class HomeController extends Controller
{
    use TemporalityTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('VerifyAbandonedActiveParticipation');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('public.home');
    }

    public function ranking(Temporality $temporality)
    {
        if(!$temporality->id){
            $temporality = Temporality::whereId(1)->first();
        }
     
        $users = UserPoint::whereTemporalityId($temporality->id)
                    ->where('points', '>', 0)
                    ->orderBy('points', 'desc')
                    ->paginate(10);

        $rank = $users->firstItem();

        $winners = UserPoint::whereTemporalityId($temporality->id)
                    ->whereWinner(1)
                    ->where('points', '>', 0)
                    ->orderBy('points', 'desc')
                    ->get();

        return view('public.ranking', compact('users', 'rank', 'winners', 'temporality'));
    }

}
