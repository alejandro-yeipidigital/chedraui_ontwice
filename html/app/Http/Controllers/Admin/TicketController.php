<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\{ParticipationUpdateRequest};
use App\Mails\{ValidTicket, InvalidTicket};
use App\Models\{Estado, Participation, UserPoint};
use App\Repositories\{ParticipationRepository, StoreRepository};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    protected $participationRepository;
    protected $waNumbersRepository;
    protected $ticketValidationService;
    protected $temporalityPointsRepository;

    public function __construct ()
    {
        $this->middleware('auth:admin');

        $this->participationRepository  = new ParticipationRepository;
        $this->storeRepository          = new StoreRepository;                      
    }

    /**
     * Display all tickets
     * 
     * @param none
     * @return View admin.tickets.index
     */
    public function index ()
    {
        // All tickets
        $tickets = $this->participationRepository->getTicketsByRegisteredUsers();

        return view('admin.tickets.index', compact([
                                                        'tickets'
                                                    ]));            
    }

    /**
     * Display pending tickets
     * 
     * @param none
     * @return View admin.tickets_pendientes.index
     */
    public function indexPendientes () 
    {
        // All tickets
        $tickets = $this->participationRepository->getPendingTickets();

        return view('admin.tickets.index', compact([
                                                        'tickets'
                                                    ]));   
    }


    /**
     * Display ticket details
     * 
     * @param Ticket $ticket
     * @return View admin.tickets.show
     */
    public function show (Participation $ticket) 
    {
        $estados    = Estado::all();
        $stores     = $this->storeRepository->all();

        return view('admin.tickets.show', compact([
                                                    'ticket',
                                                    'stores',
                                                    'estados'
                                                ]));
    }

    /**
     * Accept or reject Ticket
     * 
     * @param ParticipationUpdateRequest $request
     * @return View
     */
    public function update (ParticipationUpdateRequest $request)
    {
        // dd($request->all());
        $valido = $request->valido;
        // Revisar si el folio no ha sido utilizado previamente, 
        // revisa ??nicamente tickets v??lidos o pendientes
        $ticket_exists = Participation::where('id', '!=', $request->participation_id)
                                    ->whereTicketCode($request->folio)
                                    ->whereValidation(2)
                                    ->first();
        
        if ($ticket_exists) {
            $valido = 3;
        }

        // dd($ticket_exists);

        // Actualiza Participation
        $participation = $this->participationRepository->validateTicket($request, $valido);

        // Obtiene registro de User Points
        $user_points = UserPoint::whereTemporalityId($participation->temporality_id)
                                ->whereUserId($participation->user_id)
                                ->first();

        if ($user_points) {
            UserPoint::whereTemporalityId($participation->temporality_id)
                        ->whereUserId($participation->user_id)
                        ->update([
                            'points'  => $user_points->points + $participation->total_points
                        ]);
        } else {
            $user_points = new UserPoint;
            $user_points->user_id = $participation->user_id;
            $user_points->temporality_id = $participation->temporality_id;
            $user_points->points = $participation->total_points;
            $user_points->winner = 0;
            $user_points->save();
        }

        // Encontrar registro de User
        $user = User::find($participation->user_id);

        // Env??o de mailing ticker rechazado
        if ($valido != 2) {
            Mail::to($user->email)->send(new InvalidTicket($user, $participation));
        } else {
            // Mailing ticket valido
            Mail::to($user->email)->send(new ValidTicket($user, $participation));
        }
            
        // Obtener el mensaje de validaci??n
        $validation_message = ($valido == 2) 
                                ? 'El ticket fue aceptado.' 
                                : 'El ticket fue rechazado';

        return redirect('/admin/tickets/pendientes')->with('validation_message', $validation_message);
    }

    // /**
    //  * 
    //  */
    // public function updateOrCreateUserPoints ($user_id, $temporality_id, $new_points)
    // {
    //     $user_points = UserPoint::whereTemporalityId($participation->temporality_id)
    //                             ->whereUserId($participation->user_id)
    //                             ->first();

    //     if ($user_points) {
    //         UserPoint::whereTemporalityId($participation->temporality_id)
    //                         ->whereUserId($participation->user_id)
    //                         ->update([
    //                             'points'  => $current_points + $participation->total_points
    //                         ]);
    //     }
    // }
}
