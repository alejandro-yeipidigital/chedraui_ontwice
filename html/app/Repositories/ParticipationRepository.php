<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\{Participation};

class ParticipationRepository 
{

    public function __construct() 
    {
    }

    /**
     * Store ticket into participation table
     * 
     * @param
     * @return
     */
    public function createTicket (string $file_name, $ticket_code, $temporality_id, $user_id)
    {
        return Participation::create([
                                        'ticket'            => '/tickets/' . $file_name,
                                        'ticket_code'       => $ticket_code,
                                        'validation'        => 1,
                                        'temporality_id'    => $temporality_id,
                                        'user_id'           => $user_id
                                    ]);
    }

    /**
     * Validate ticket
     * 
     * @param $request
     * @return Participation
     */
    public function validateTicket ($request)
    {
        $participation = Participation::find($request->participation_id);
        $participation->total_ticket    = $request->total;
        $participation->ticket_code     = $request->folio;
        $participation->validation      = $request->valido;
        $participation->store           = $request->store_id;
        $participation->pay             = $request->payment;
        $participation->main_product    = $request->main_product;
        $participation->other_products  = $request->other_products;
        $participation->reason          = $request->reason;
        $participation->save(); 

        return $participation;
    }

    /**
     * Count tickets register by user today
     * 
     * @param int $user_id
     * @return int $today_tickets
     */
    public function countUserTodayTickets (int $user_id) : int
    {
        return Participation::whereUserId($user_id)
                        ->whereDate('created_at', Carbon::today())
                        ->whereFree(0)
                        ->count();
    }

    /**
     * Retrive tickets from registered users
     * @param none
     * @return $tickets
     */
    public function getTicketsByRegisteredUsers () 
    {
        return Participation::all();
    }

    /**
     * Get pending tickets
     * 
     * @param none
     * @return 
     */
    public function getPendingTickets()
    {
        return Participation::whereValidation(1)->get();
    }

    /**
     * Retrive pending tickets from registered users
     * @param none
     * @return $pending_tickets
     */
    // public function getPendingTicketsByRegisteredUsers () 
    // {
    //     return Ticket::join('users', 'users.id', '=', 'tickets.user_id')
    //                 ->join('temporalities', 'tickets.temporality_id', '=', 'temporalities.id')
    //                 ->where('tickets.validated', '=', 0)
    //                 ->orderBy('created_at', 'desc')
    //                 ->get([
    //                         'tickets.id',
    //                         'tickets.user_id',
    //                         'tickets.validated',
    //                         'tickets.valid',
    //                         'tickets.created_at',
    //                         'users.name',
    //                         'users.active',
    //                         'temporalities.name AS temporality_name'
    //                     ]);
    // }

    // /**
    //  * Creates a ticket
    //  * @param $user_id, $ticket_name, $ticket_type
    //  * @return Ticket $ticket
    //  */
    // public function createTicket ($user_id, $temporality_id, $ticket_name) 
    // {
    //     $ticket = new Ticket;
    //     $ticket->user_id        = $user_id;
    //     $ticket->temporality_id = $temporality_id;
    //     $ticket->ticket         = $ticket_name;
    //     $ticket->save();

    //     return $ticket;
    // }

    // /**
    //  * Obtain ticket with all relevant data to validte
    //  * @param int $ticket_id
    //  * @return object $ticket
    //  */
    // public function ticketDetails (int $ticket_id) : object 
    // {
    //     // Find Ticket
    //     $ticket = Ticket::find($ticket_id);
        
    //     // Retrive Whatsapp Number with User, Promotion, Country data
    //     $user =  $this->userRepository->findUser($ticket->user_id);

    //     $country = $this->countryRepository->findCountry(1);

    //     // Add to ticket
    //     $ticket->promotion_id   = 1;
    //     $ticket->rules          = '$whatsapp_number->promotion->ticket_validation_metrics';
    //     $ticket->country_id     = 1;
    //     $ticket->country_acronym= $country->acronym;
    //     $ticket->wa_number      = $user->wa_number;
    //     $ticket->user_id        = $user->id;
    //     $ticket->name           = $user->name;
    //     $ticket->observations   = $user->observations;

    //     return $ticket;
    // }

    // /**
    //  * Update ticket with validation values
    //  * @param int $ticket_id
    //  * @param float $total, 
    //  * @param int $points, 
    //  * @param bool $valid
    //  * @param string $folio
    //  * @return Ticket $ticket
    //  */
    // public function validateTicket (int $ticket_id, float $total, int $points, bool $valid, string $folio) 
    // {
    //     return Ticket::whereId($ticket_id)
    //                 ->update([
    //                             'total'     => $total,
    //                             'points'    => $points,
    //                             'validated' => 1,
    //                             'valid'     => $valid,
    //                             'folio'     => $folio
    //                         ]);
    // }

    // /**
    //  * Obtain registered ticket total
    //  * @param int $user_id
    //  * @param int $temporality_id
    //  * @return int $total_tickets
    //  */
    // public function getUserTemporalityTickets(int $user_id, int $temporality_id) {
    //     return Ticket::whereUserId($user_id)
    //                 ->whereTemporalityId($temporality_id)
    //                 ->count();
    // }

    // /**
    //  * Counts the tickets registered on this day by the user
    //  * @param int $user_id, $start, $end
    //  * @return int $tickets_total
    //  */
    // public function countUserTodaysTickets(int $user_id, $start, $end) {
    //     return Ticket::whereUserId($user_id)
    //                 ->where('created_at', '>=', $start)
    //                 ->where('created_at', '<=', $end)
    //                 ->whereValidated(1)
    //                 ->whereValid(1)
    //                 ->count();
    // }

    // /**
    //  * Count all the tickets registered in the promotion
    //  * @return int $total_tickets
    //  */
    // public function countAllTickets () : int 
    // {
    //     return Ticket::count();
    // }

    // /**
    //  * Delete user tickets
    //  * @param $user_id
    //  * @return void
    //  */
    // public function deleteUserTickets (int $user_id) : void 
    // {
    //     Ticket::whereUserId($user_id)->delete();
    // }

    // /**
    //  * Get first ticket
    //  * @param $user_id
    //  * @return Ticket $ticket
    //  */
    // public function getFirstTicket (int $user_id) 
    // {
    //     return Ticket::whereUserId($user_id)->first();
    // }

    // /**
    //  * Update ticket temporality
    //  * @param $id, $temporality_id
    //  * @return Ticket $ticket
    //  */
    // public function updateTicketTemporalityId (int $id, int $temporality_id) 
    // {
    //     return Ticket::whereId($id)
    //                 ->update([
    //                     'temporality_id' => $temporality_id 
    //                 ]);
    // }

    // /**
    //  * Verify ticket folio uniqueness
    //  * 
    //  * @param string $folio
    //  * @return bool $unique_ticket_folio
    //  */
    // public function uniqueTicketFolio (string $folio) : bool
    // {
    //     return (Ticket::whereFolio($folio)->whereValid(1)->count() > 0) ? false : true;
    // }
}