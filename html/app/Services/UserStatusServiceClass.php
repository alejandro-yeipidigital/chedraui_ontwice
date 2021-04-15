<?php

namespace App\Services;

use App\Http\Traits\{TicketLimitTrait};
use App\Services\{AgeServiceClass, TicketServiceClass, TyCServiceClass, WelcomeServiceClass};
use App\Repositories\{TicketRepository, WANumbersRepository, UserRepository};

class UserStatusServiceClass 
{
    use TicketLimitTrait;

    protected $wANumbersRepository;
    protected $userRepository;

    public function __construct($promotion_id, $country_id, $language, $temporality_id) {
        $this->wANumbersRepository      = new WANumbersRepository;
        $this->userRepository           = new UserRepository;
        $this->promotion_id             = $promotion_id;
        $this->country_id               = $country_id;
        $this->language                 = $language;
        $this->temporality_id           = $temporality_id;
    }

    /**
     * Get the User Status and the corresponding message
     * @param string $language
     * @param string $wa_number
     * @param $user_response
     * @param $image_url
     * @return string $body
     */
    public function getUserStatusMessage(string $wa_number, $user_response, $image_url) : array {
        // Get whatsapp
        $whatsapp = $this->userRepository->getWANumber($wa_number);

        // Verify if whatsapp is registered
        if (!$whatsapp) {
            // Creates new whatsapp
            $whatsapp = $this->createWANumber($wa_number);

            $messages[] = config('bot_messages.' . $this->language . '.bienvenida');
        
            return [
                        'body' => $messages,
                        'user_id' => $whatsapp->id
                    ];
        }

        // Verifies if temporalities are active for the country
        if(!$this->temporality_id) {
            $messages[] = config('bot_messages.' . $this->language . '.temporalidad_finalizada');

            return [
                        'body' => $messages,
                        'user_id' => $whatsapp->id
                    ];
        }

        // Verifies if user is blocked
        if ($whatsapp->blocked) {
            info('entra en bloqueado');
            $messages[] = config('bot_messages.' . $this->language . '.usuario_bloqueado');

            return [
                        'body' => $messages,
                        'user_id' => $whatsapp->id
                    ];
        }

        // Verify is user has exceded ticket daily limit
        if ($this->countUserTodaysTickets($whatsapp->id, $this->country_id) >= $this->dailyTicketLimit()) {
            $messages[] = config('bot_messages.' . $this->language . '.limite_tickets');

            return [
                        'body' => $messages,
                        'user_id' => $whatsapp->id
                    ];
        }

        // Get user current status
        $user_status = $this->getUserStatus($whatsapp->id);

        // Get Status corresponding mesages
        return $this->getStatusMessages($user_status, $this->language, $whatsapp->id, $user_response, $image_url);
    }

    /**
     * Creates new user and attaches welcome and TyC statuses
     * @param string $wa_number
     * @param int $promotion_id
     * @return string $message
     */
    public function createWANumber(string $wa_number) : object {
        $user = $this->userRepository->createUser($wa_number);

        $user->status()->attach([
                1 => ['active' => 0], // Bienvenida 
                2 => ['active' => 1]  // Esperando empezar
            ]);

        return $user;
    }

    /**
     * Retrieves the user status from database
     * @param int $user_id
     * @return int $status_id
     */
    public function getUserStatus($whatsapp_id) {
        $whatsapp_status = $this->userRepository->getUserStatus($whatsapp_id);
        return $whatsapp_status->pivot->status_id;
    }

    /**
     * Counts the tickets registered on this day by the user
     */
    public function countUserTodaysTickets($whatsapp_id, $country_id) {
        $ticketService = new TicketServiceClass($this->temporality_id);
        $total = $ticketService->countUserTodaysTickets($whatsapp_id, $country_id);
        info("Total de mensajes hoy");
        info($total);
        return $total;
    }

    /**
     * Obtains the body message depending on user status
     * @param
     * @return array $response
     */
    public function getStatusMessages($user_status, $language, $whatsapp_id, $user_response, $image_url) : array {
        switch ($user_status) {
            // Esperando empezar
            case 2:
                $welcome_service = new WelcomeServiceClass($this->promotion_id);
                $messages = $welcome_service->getResponse($language, $whatsapp_id, strtolower($user_response), $image_url);
                break;
            // Mayoría de Edad
            case 3:
                $age_service = new AgeServiceClass;
                $messages = $age_service->getResponse($language, $whatsapp_id, strtolower($user_response), $image_url);
                break;
            // Términos y Condiciones
            case 4:
                $tyc_service = new TyCServiceClass;
                $messages = $tyc_service->getResponse($language, $whatsapp_id, strtolower($user_response), $image_url);
                break;
            // Esperando correo
            case 5: 
                $register_service = new RegisterServiceClass($this->promotion_id);
                $messages = $register_service->getResponse($language, $whatsapp_id, strtolower($user_response), $image_url);
                break;
            // Esperando nombre
            case 6: 
                $register_service = new RegisterServiceClass($this->promotion_id);
                $messages = $register_service->storeName($language, $whatsapp_id, $user_response, $image_url);
                break;
            // Esperando RUT
            case 7: 
                $register_service = new RegisterServiceClass($this->promotion_id);
                $messages = $register_service->storeRut($language, $whatsapp_id, $user_response, $image_url);
                break;
            // // Esperando apellido paterno
            // case 7: 
            //     $register_service = new RegisterServiceClass($this->promotion_id);
            //     $messages = $register_service->storeMiddleName($language, $whatsapp_id, $user_response, $image_url);
            //     break;
            // // Esperando apellido materno
            // case 8: 
            //     $register_service = new RegisterServiceClass($this->promotion_id);
            //     $messages = $register_service->storeLastName($language, $whatsapp_id, $user_response, $image_url);
            //     break;
            // Esperando telefono de contacto
            case 8: 
                $register_service = new RegisterServiceClass($this->promotion_id);
                $messages = $register_service->storeTelephone($language, $whatsapp_id, $user_response, $image_url);
                break;
            // Esperando confirmación de datos
            case 9: 
                $register_service = new RegisterServiceClass($this->promotion_id);
                $messages = $register_service->confirmData($language, $whatsapp_id, strtolower($user_response), $image_url);
                break;
            // Esperando imagen
            case 10:
                $ticket_service = new TicketServiceClass($this->temporality_id);
                $messages = $ticket_service->getResponse($language, $whatsapp_id, $user_response, $image_url);
                break;
            // Validación de Imagen
            case 11:
                $messages[] = config('bot_messages.' . $language . '.recordatorio_ticket_validacion');
                break;
            default:
                $messages = ['Lo siento 😢 Ocurrío un error inesperado 🙈'];
                break;
        }

        return [
                'body'      => $messages,
                'user_id'   => $whatsapp_id
            ];
    }
}