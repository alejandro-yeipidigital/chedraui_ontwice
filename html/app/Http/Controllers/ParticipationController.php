<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Requests\StorePaticipationRequest;
use App\Models\{DailyTicket, Participation, Url, UserPoint};
use App\Repositories\{ParticipationRepository};
use App\Traits\TemporalityTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ParticipationController extends Controller
{
    use TemporalityTrait;

    public function __construct()
    {
        $this->middleware('auth:web');

        $this->participationRepository = new ParticipationRepository;
    }

    /**
     * Return indez view
     * 
     * @param none
     * @return View
     */
    public function index () 
    {
        return view('public.tickets.registerTicket');
    }

    /**
     * Upload user tickets and stored
     * 
     * @param Request $request
     * @return Redirect
     */
    public function upload (StorePaticipationRequest $request)
    {
        // Obtener temporalidad actual
        $temporality = $this->activeTemporality();

        // Si la temporalidad finalizó
        if ($temporality->finalized == 1) {
            return redirect()->route('tickets.index')
                        ->withInput()
                        ->withErrors([
                                        'ticket_code' => 'Las fases de participación han finalizado.'
                                        ]);
        }

        // Obtener usuario que está logueado
        $user = auth()->user();

        // Si el usuario está bloqueado
        if ($user->active == 0) {
            return redirect()->route('tickets.index')
                        ->withInput()
                        ->withErrors([
                                        'ticket_code' => 'Has infligido nuestros Términos y Condiciones'
                                        ]);
        }

        // Obtener numero de tickets ingresados el dia de hoy por el usuario
        $no_tickets = $this->participationRepository->countUserTodayTickets($user->id);

        // Obtener el limite de tickets diarios por usuario
        $config_no_tickets = DailyTicket::first();

        // Revisar que el número de tickets subidos por el usuario no supere el limite diario de partipaciones
        if ($no_tickets >= $config_no_tickets->total_tickets_by_day) {
            return redirect()->route('tickets.index')
                            ->withInput()
                            ->withErrors([
                                            'ticket_code' => 'Superaste el límite de tickets por día'
                                            ]);
        }

        // Revisar que el ticket no haya subido antes
        $existing_ticket = Participation::whereTicketCode($request->ticket_code)
                                            ->where('validation', '!=', 3)
                                            ->first();

        if ($existing_ticket) {
            return redirect()->route('tickets.index')
                            ->withInput()
                            ->withErrors([
                                            'ticket_code' => 'Este ticket ya ha sido utilizado.'
                                            ]);
        }

        // Generar nombre para guardar el ticket
        $file_name = $this->createTicketName($request, $user->id);

        // Almacenar Ticket en Storage
        Storage::putFileAs(
            'public/tickets', 
            $request->file('ticket'), 
            $file_name
        );

        // REGISTRAR TICKET en Base de datos
        $ticket_data = $this->participationRepository->createTicket($file_name, $request->ticket_code, $temporality->id, $user->id);

        return redirect()->route('users.profile')
                        ->with('status', [
                                            'status'    => 'success'
                                        ]);

    }
    
    /**
     * Create ticket name
     * 
     * @param $request, $user_id
     * @return string
     */
    public function createTicketName ($request, $user_id) : string
    {
        $fecha_actual = Carbon::now()->toDateTimeString();
        $foto_ticket = $request->file('ticket');
        
        return $request->ticket_code
            . "_user_" . $user_id
            . "_" . str_replace(" ", "_", str_replace(":", "", $fecha_actual))
            . "." . $foto_ticket->getClientOriginalExtension();
    }
}
