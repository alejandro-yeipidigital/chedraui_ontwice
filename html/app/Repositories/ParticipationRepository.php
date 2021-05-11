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
    public function validateTicket ($request, $valido)
    {
        $participation = Participation::find($request->participation_id);
        $participation->total_ticket    = $request->total;
        $participation->total_points    = ($valido == 2) ? (int) $request->total : 0;
        $participation->ticket_code     = $request->folio;
        $participation->validation      = $valido;
        $participation->store           = $request->store;
        $participation->pay             = $request->payment;
        $participation->main_product    = $request->main_product;
        $participation->other_products  = $request->other_products;
        $participation->reason          = $request->reason;
        $participation->region          = $request->region;
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
}