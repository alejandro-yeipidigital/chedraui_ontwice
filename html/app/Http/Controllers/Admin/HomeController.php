<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\{TicketRepository, UserRepository};

class HomeController extends Controller
{
    protected $ticketsRepository;
    protected $userRepository;

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->ticketsRepository    = new TicketRepository;
        // $this->userRepository         = new UserRepository;
    }

    /**
     * Show Admin Dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets                = 0;
        // $this->ticketsRepository->countAllTickets();
        $registered_users       = 0;
        // $this->userRepository->countRegisteredUsers();

        $response = [
            0 => [
                'classification' => 'Tickets Registrados',
                'total' => $tickets
            ],
            1 => [
                'classification' => 'Usuarios Registrados',
                'total' => $registered_users
            ] 
        ];

        $response = json_encode($response);

        return view('admin.home')->with(compact(['tickets', 'registered_users', 'response']));
    }
}