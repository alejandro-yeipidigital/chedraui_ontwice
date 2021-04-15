<?php

namespace App\Services;

use App\Http\Traits\{TwilioImageTrait};
use App\Models\{Country, MessageLog};
use App\Repositories\{AccountRepository, CountryRepository, MessageLogRepository, PromotionRepository, WANumbersRepository};
use App\Services\{UserStatusServiceClass};
use Twilio\Rest\Client;

class WAMessageBuilder 
{
    use TwilioImageTrait;

    private $message;

    public function __construct() {
        $this->message = new \stdClass;
    }

    // | ----------------------------------|
    // |               Setters             |
    // | ----------------------------------|
    /**
     * Adds the API keys to the object
     * @param $wa_number
     * @return message $this
     */
    public function setKeys(string $wa_number) {
        $accountRepository = new AccountRepository;
        $accountKeys = $accountRepository->getAccountKeys($wa_number);

        if (count($accountKeys) == 0) {
            $this->message->account_id  = null;
            $this->message->wa_number   = null;
            $this->message->account_sid = null;
            $this->message->token       = null;
            
            // Step Validation Failed
            $this->message->correct_keys = false;
        } else {
            info('Account: ');
            info($accountKeys[0]);

            $this->message->account_id  = $accountKeys[0]->id;
            $this->message->wa_number   = $accountKeys[0]->wa_number;
            $this->message->account_sid = $accountKeys[0]->account_sid;
            $this->message->token       = $accountKeys[0]->token;

            // Get Country
            $country = Country::whereId($accountKeys[0]->country_id)->first();
            $this->message->country_id = $country->id;
            
            // Add language to message
            $this->message->language = $country->acronym;

            // Step Validation Passed
            $this->message->correct_keys = true;
        }

        return $this;
    }

    /**
     * Adds promotion info to message instance
     * @param $promotion_id
     * @return message $this
     */
    public function setPromotion($promotion_id) {
        // Add promotion id to message
        $promotionRepository    = new PromotionRepository;
        $promotion              = $promotionRepository->findPromotion($promotion_id);

        if ($promotion == null) {
            $this->message->promotion_id    = null;
            $this->message->valid_promotion = false;            
          
            return $this;
        } 

        $this->message->promotion_id    = $promotion->id;
        $this->message->valid_promotion = true;            
          
        return $this;
    }

    /**
     * Adds temporality to Message object
     * @return $this
     */
    public function setTemporality() {
        $temporality_service = new TemporalityServiceClass;
        $temporality = $temporality_service->getCurrentTemporality($this->message->promotion_id);

        if (!$temporality) {
            $this->message->temporality_id      = null;

            return $this;
        }

        $this->message->temporality_id          = $temporality->id;
        $this->message->temporality_finalized   = $temporality->finalized;

        return $this;
    }

    /**
     * Sets the Whatsapp number of the message receiver
     * @param string $receiver
     */
    public function setReceiver(string $receiver) {
        $this->message->receiver = $receiver;
        return $this;
    }

    /**
     * Add user response to Object
     * @param string $response
     */
    public function userResponse($message_received_sid, $response, $image=null) {
        $this->message->message_received_sid    = $message_received_sid;
        $this->message->user_response           = $response;
        
        // Store image
        if ($image) {
            $this->message->image_url = $image;
            
            // Store image in server
            $image_name = $this->storeImage($this->message->receiver, $image, 'images');
            
            $this->message->image = '/images/' . $image_name;    
        } else {
            $this->message->image = $image;
            $this->message->image_url = $image;
        }

        return $this;
    }

    /**
     * Sets the Whatsapp body message
     * If body is not set, automatically will look for the corresponding
     * user status message
     * @param array $body
     */
    public function setBody(array $body=null) {
        $message = $this->message;

        // If body message is provided
        if (isset($body)) {
            // Sets Body
            $message->body = $body;
            
            // Sets User Id
            try {
                $waNumberRepository = new WANumbersRepository;
                $user_id = $waNumberRepository->getByWhatsappNumber($this->getReceiver());
                $message->user_id = $user_id->id;
            } catch (\Exception $e) {
                info("Falla al obtener whatsapp number id para devolver valido o rechazado");
                $message->user_id = 1;
            }

            return $this;
        } 
        
        // If a message body is not provided then get the corresponding message to the user's status
        $user_status = new UserStatusServiceClass($message->promotion_id, $message->country_id, $message->language, $message->temporality_id);
        $response = $user_status->getUserStatusMessage($message->receiver, $message->user_response, $message->image_url);
    
        // Sets Body
        $message->body = $response['body'];
        
        // Sets User Id
        $message->user_id = $response['user_id'];

        info('Body');
        info($response['body']);

        return $this;
    }

    /**
     * Register the Message sent by the user in the database
     */
    public function registerMessageReceived(){
        $message = $this->message;

        // Event Register Message Received
        $new_message = new MessageLogRepository;
        $new_message->createMessageLog(
                                        $message->temporality_id,       // temporality_id
                                        $message->user_id,              // user_id
                                        $message->account_id,           // account_id
                                        $message->user_response,        // body
                                        $message->image,                // media
                                        $message->message_received_sid, // message sid
                                        'received'                      // status
                                    );

        return $this;
    }

    /**
     * Register the Message sent to the user in the database
     * @param string $body
     */
    public function registerMessageSent() {
        $message = $this->message;

        // Event Register Message Received
        $new_message = new MessageLogRepository;

        foreach ($message->body as $body) {
            $new_message->createMessageLog(
                                        $message->temporality_id,       // temporality_id
                                        $message->user_id,              // user_id
                                        $message->account_id,           // account_id
                                        $body,                          // body
                                        null,                           // media
                                        '-', // message sid
                                        'sent'                          // status
                                    );
        }

        return $this;
    }

    /**
     * Sends Twilio's Whatsapp Message
     * @return $message
     */
    public function send() {
        $twilio = $this->message;

        $client = new Client($twilio->account_sid, decrypt($twilio->token));
       
        $count = 0;
        foreach ($twilio->body as $body) {
            info('Body ' . $count);
            info($body);
            $count++;
            
            $client->messages->create($twilio->receiver, // to
            [
                "from" => $twilio->wa_number,
                "body" => $body
                ]);
            
            info('Enviado');
        }
            
        return $this;
    }

    // | ----------------------------------|
    // |               Getters             |
    // | ----------------------------------|
    /**
     * Retrieves the message body
     */
    public function getBody() {
        return $this->message->body;
    }

    /**
     * Retrives the API keys
     */
    public function getKeys() {
        info('Wa number');
        info($this->message->wa_number);
        info('Sid');
        info($this->message->account_sid);
        info('Token');
        info($this->message->token);
    }

    /**
     * Retrives the Whatsapp number of the receiver
     */
    public function getReceiver() {
        return $this->message->receiver;
    }

    /**
     * Verifies if Account Keys are Valid
     * @return bool $valid_keys
     */
    public function areAccountKeysValid() : bool {
        return $this->message->correct_keys;
    }

    /**
     * Verify if Country linked to the Account is active
     * @return bool $active_country
     */
    public function isAccountActive() : bool {
        // Verify if country is active
        $countryRepository = new CountryRepository;
        $is_country_active = $countryRepository->isAccountCountryActive($this->message->country_id);

        // Verify if account is active
        $accountRepository = new AccountRepository;
        $is_account_active = $accountRepository->isAccountActive($this->message->account_id);

        return $is_country_active && $is_account_active;
    }

    /**
     * Verify if promotion exists and is active
     * @return bool $active_promotion
     */
    public function isPromotionActive() {
        if ($this->message->valid_promotion == false) {
            info('Muere');
            return false;
        }

        $promotionRepository = new PromotionRepository;
        return $promotionRepository->isPromotionActive($this->message->promotion_id);
    }

    /**
     * Verify is temporality exists and if its playable
     * @return bool $temporality_playable
     */
    public function isTemporalityPlayable() : bool {
        if(!isset($this->message->temporality_id)) {
            return false;
        }

        if ($this->message->temporality_finalized == 1) {
            return false;
        }

        return true;
    }
}