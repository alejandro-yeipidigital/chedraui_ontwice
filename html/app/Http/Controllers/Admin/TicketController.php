<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\{ParticipationUpdateRequest};
use App\Mails\{ValidTicket, InvalidTicket};
use App\Models\{Participation, UserPoint};
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
        $stores = $this->storeRepository->all();

        return view('admin.tickets.show', compact([
                                                    'ticket',
                                                    'stores'
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

        // Actualiza Participation
        $participation = $this->participationRepository->validateTicket($request);

        // Obtiene registro de User Points
        $user_points = UserPoint::whereTemporalityId($participation->temporality_id)
        ->whereUserId($participation->user_id)
        ->first();
        
        // Actualizar User Points
        $dataToUpdate = [
                            'validated_points'  => $user_points->validated_points + $participation->total_points,
                            'pending_points'    => $user_points->pending_points - $participation->total_points,
                        ];

        // actualizamos el valor completo de datos
        UserPoint::whereTemporalityId($participation->temporality_id)
                            ->whereUserId($participation->user_id)
                            ->update( $dataToUpdate );

        // Encontrar registro de User
        $user = User::find($participation->user_id);

        // Envío de mailing
        if ($request->valido == 2) {
            Mail::to($user->email)->send(new ValidTicket($user, $participation));
        } 
        else {
            Mail::to($user->email)->send(new InvalidTicket($user, $participation));
        }
        

        // return redirect(route('tickets.main'))->with('status',[
        //     'status'    => 'success',
        //     'message'   => "El ticke se validó correctamente"
        // ]);

        // Obtener el mensaje de validación
        $validation_message = ($request->valido == 2) ? 'El ticket fue aceptado.' : 'El ticket fue rechazado';

        return redirect('/admin/tickets/pendientes')->with('validation_message', $validation_message);
    }
}
