<?php

namespace App\Repositories;

use App\Models\{WhatsappNumber};

class WANumbersRepository 
{
    /**
     * Get user info by its whatsapp number
     * @param int $whatsapp_id
     * @return WhatsappNumber $whatsapp
     */
    public function getUserByNumber(int $whatsapp_id) {
        return  WhatsappNumber::with('user')
                            ->with('promotion')
                            ->find($whatsapp_id);
    }

    /**
     * Retrieve Whatsapp number data by its
     * whatsapp number string
     * @param string $wa_number
     * @return Whatsapp_Number
     */
    public function getByWhatsappNumber($wa_number) {
        return WhatsappNumber::whereWaNumber($wa_number)->first();
    }

    /**
     * Get Whatsapp Number by user id
     * @param $user_id
     * @return WhatsappNumber
     */
    public function getByUser($user_id) {
        return WhatsappNumber::whereUserId($user_id)->first();
    }

    /**
     * Retrives user by its wa_number
     * @param string $wa_number
     * @param int $promotion_id
     * @return User $user
     */
    public function getWANumber(string $wa_number, int $promotion_id) {
        return WhatsappNumber::whereWaNumber($wa_number)
                            ->wherePromotionId($promotion_id)
                            ->first();
    }

    /**
     * Verifies is Whatsapp number has a related user
     * @param int $whatsapp
     * @return bool 
     */
    public function isUserRegistered(int $whatsapp_id) : bool {
        $hasUser = WhatsappNumber::whereId($whatsapp_id)
                                ->where('user_id', '!=', null)
                                ->first();
        return ($hasUser)
                ? true
                : false;
    }

    /**
     * Creates a new User
     * @param string $wa_number, $country_id
     * @return User $user
     */
    public function createWANumber($wa_number, $promotion_id) {
        $user = new WhatsappNumber;
        $user->wa_number    = $wa_number;
        $user->promotion_id   = $promotion_id;
        $user->user_id      = null;
        $user->unique_code  = null;
        $user->email        = null;
        $user->ticket_type  = null;
        $user->save();

        return $user;
    }


    /**
     * Get's the ticket type
     * @param $whatsapp_id
     * @return $ticket_type
     */
    public function getTicketType($whatsapp_id) {
        $whatsapp = WhatsappNumber::whereId($whatsapp_id)->first();
        
        return $whatsapp->ticket_type;
    }

    /**
     * Update User's Ticket type
     * @param $whatsapp_id, $ticket_type
     * @return Ticket $ticket
     */
    public function updateTicketType($whatsapp_id, $ticket_type) {
        return WhatsappNumber::whereId($whatsapp_id)
                    ->update([ 
                                'ticket_type' => $ticket_type
                                ]);
    }

    /**
     * Sets user unique register code
     * @param $whatsapp_id, $unique_code
     * @return $user
     */
    public function addUniqueCode($whatsapp_id, $unique_code) {
        return WhatsappNumber::whereId($whatsapp_id)
                    ->update([
                                'unique_code' => $unique_code
                                ]);
    }

    /**
     * Blocks or unblocks a whatsapp number
     * @param int $whatsapp_id
     * @param bool $status
     * @return $whatsapp_number
     */
    public function blockWhatsAppNumber(int $whatsapp_id, bool $status) {
        return WhatsappNumber::whereId($whatsapp_id)
                            ->update([
                                        'blocked' => $status
                                    ]);
    }

    /**
     * Find whatsapp numberby unique code
     * @param int $unique_code
     * @return WhatsappNumber $whatsapp
     */
    public function findByUniqueCode(int $unique_code) {
        return WhatsappNumber::whereUniqueCode($unique_code)->first();
    }

    /**
     * Find Whatsapp number by its unique code and links user_id
     * @param int $unique_code
     * @return void
     */
    public function linkUser(int $unique_code) : void {
        WhatsappNumber::whereUniqueCode($unique_code)
                        ->update([
                                'user_id' => \Auth::user()->id
                            ]);
    }

    /**
     * Delete Whatsapp number register
     * @param int $id
     * @return void
     */
    public function deleteWhatsappNumber(int $id) : void {
        WhatsappNumber::whereId($id)->delete();
    }
}