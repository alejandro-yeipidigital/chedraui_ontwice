<?php

namespace App\Services;

use App\Events\{PendingRegisterEvent, TicketReceivedEvent};
use App\Http\Traits\{TwilioImageTrait};
use App\Services\AbstractClasses\StatusAbstract;
use App\Repositories\{TicketRepository, UserRepository, WANumbersRepository};
use Carbon\Carbon;
use Twilio\Rest\Client;

class TicketServiceClass extends StatusAbstract
{
    use TwilioImageTrait;

    public function __construct($temporality_id) {
        $this->temporality_id   = $temporality_id;
        $this->ticketRepository = new TicketRepository;
        $this->userRepository   = new UserRepository; 
        $this->wRepository      = new WANumbersRepository;
    }

    /**
     * Stores ticket type in DB
     * @param $language, $user_id, $user_response, $image_url
     * @return array $messages
     */
    public function setTicketType ($language, $user_id, $user_response, $image_url) : array 
    {
        info("SIGUE ENTRANDO EN TICKET TYPE");
        // If user response is 1 or 2
        if (in_array($user_response, ['tienda', 'internet'])) {
            // Set ticket type
            ($user_response == 'tienda') ? $ticket_type = 1 : $ticket_type = 2;

            // Update ticket type
            $this->wRepository->updateTicketType($user_id, $ticket_type);

            // Update user participation status
            $this->updateUserStatus($user_id, 7);

            // Generate Response
            $messages = [];
            $messages[] = config('bot_messages.' . $language . '.imagen_requerida');
            
            return $messages;
        }
        
        return [config('bot_messages.' . $language . '.tipo_rechazado')];
    }

    /**
     * Recibes and stores the ticket
     * 
     * @param $language, $user_id, $user_response, $image_url
     * @return array $messages
     */
    public function getResponse ($language, $user_id, $user_response, $image_url) : array 
    {
        // Verifies if and image was sent
        if(!isset($image_url)) {
            return [config('bot_messages.' . $language . '.imagen_requerida')];
        }

        // Store image in server
        $ticket_name = $this->storeTicket($user_id, $image_url, 'tickets');

        // Store ticket in DB
        $this->ticketRepository->createTicket($user_id, $this->temporality_id, $ticket_name);

        $messages = [];
        $status_id = 11;
        
        // Generate Response
        $messages[] = config('bot_messages.' . $language . '.ticket_recibido');
        $messages[] = config('bot_messages.' . $language . '.ticket_validacion');
        $messages[] = config('bot_messages.' . $language . '.consultar_progreso');

        // Update Status
        $this->updateUserStatus($user_id, $status_id);

        return $messages;
    }

    /**
     * Count tickets uploaded by user this day
     * @param $user_id,
     * @param $country_id
     * @return in $total_tickets
     */
    public function countUserTodaysTickets($user_id, $country_id) {
        $now    = Carbon::now();        
        $start  = Carbon::parse($now->format('Y-m-d' . ' 0:00:00'))->toDateTimeString();
        $end    = Carbon::parse($now->format('Y-m-d' . ' 23:59:59'))->toDateTimeString();

        return $this->ticketRepository->countUserTodaysTickets($user_id, $start, $end);
    }
}