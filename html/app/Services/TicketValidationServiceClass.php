<?php

namespace App\Services;

use App\Http\Traits\{TicketLimitTrait, UserStatusTrait};
use App\Repositories\{TicketRepository};

class TicketValidationServiceClass 
{
    use TicketLimitTrait;
    use UserStatusTrait;

    protected $ticketRepository;

    public function __construct () 
    {
        $this->ticketRepository = new TicketRepository;
    }

    /**
     * Verify if ticket is valid depending on promotion's rules
     * @param object $request
     * @return array $response
     */
    public function verifyTicket (object $request) : array 
    {
        // Verify if ticket folio is unique, else reject ticket
        $folio = str_replace(' ', '', $request->folio);

        if (!$this->ticketRepository->uniqueTicketFolio($folio)) {
            return [
                    'points'        => 0,
                    'valid_ticket'  => false,
                    'message'       => 'El número de folio ya ha sido utilizado previamente.'
                ];
        }

        // Ticket is not Valid Or Total is not $3,000 or more
        if ($request->valido == 0 || $request->total < 3000) {
            return [
                    'points' => 0,
                    'valid_ticket' => false
                ];
        }

        // If Total is $3,000 or more, calculate points
        return [
                'points' => $request->total,
                'valid_ticket' => true
            ];
    }

    /**
     * Obtains Whatsapp user response and updates user bot status
     * @param $whatsapp_id, 
     * @param $valid_ticket, 
     * @param $acronym
     * @return array $body
     */
    public function getBodyMessage ($user_id, $valid_ticket, $acronym, $temporality_id , $country_id) : array 
    {
        $body = [];
        
        // Add new status
        $this->updateUserStatus($user_id, 10); // Esperando imagen

        // Obtain corresponding message if ticket was accepted or rejected
        if ($valid_ticket === true) {
            $body[] = config('bot_messages.' . $acronym . '.ticket_valido');
            $body[] = config('bot_messages.' . $acronym . '.ticket_nuevo_flujo');
        } else {
            $body[] = config('bot_messages.' . $acronym . '.ticket_rechazado');  
        }
        
        // Count tickets to verify if user has reached daily limit
        $ticketService = new TicketServiceClass($temporality_id);

        ($ticketService->countUserTodaysTickets($user_id, $country_id) >= $this->dailyTicketLimit())
            ? $body[] = config('bot_messages.' . $acronym . '.limite_tickets')
            : $body[] = config('bot_messages.' . $acronym . '.imagen_requerida');

        return $body;
    }
}