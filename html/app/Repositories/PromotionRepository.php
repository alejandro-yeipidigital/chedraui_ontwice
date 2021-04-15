<?php

namespace App\Repositories;

use App\Models\{Promotion, Temporality, Ticket, MessageLog};

class PromotionRepository 
{
    /**
     * Find promotion
     * @param int $promotion_id
     * @return Promotion $promotion
     */
    public function findPromotion ($promotion_id) 
    {
        return Promotion::find($promotion_id);
    }

    /**
     * Obtain all promotions
     * @return Promotion
     */
    public function allPromotions () 
    {
        return Promotion::all();
    }

    /**
     * Get Promotion by it's country id
     * @param int $country_id
     * @return Promotion $promotion
     */
    public function getPromotionByCountryId (int $country_id) 
    {
        return Promotion::whereCountryId($country_id)
                        ->whereActive(1)
                        ->first(['id', 'country_id', 'name', 'active']);
    }

    /**
     * Get Promotion Details for users
     * @param int $promotion_id
     * @return object $promotion_details
     */
    public function getPromotionDetails (int $promotion_id) : object
    {
        $promotion_details = Promotion::join('countries', 'countries.id', '=', 'promotions.country_id')
                                        ->where('promotions.id', '=', $promotion_id)
                                        ->get([
                                            'promotions.id',
                                            'promotions.name',
                                            'countries.name AS country_name'
                                            ]);
        $promotion_details = (object) $promotion_details[0];

        return $promotion_details;
    }

    /**
     * Verify is promotion is active
     * @param int $promotion_id
     * @return bool $active
     */
    public function isPromotionActive (int $promotion_id) : bool 
    {
        $promotion = Promotion::find($promotion_id);

        return ($promotion->active == 1)
                ? true
                : false;
    }

    /**
     * Get whatsapp ids registered in promotion
     * @param int $promotion_id
     * @return object
     */
    public function getWhatsappIdsInPromotion (int $promotion_id) : object 
    {
        // dd($promotion_id);
        return Promotion::join('whatsapp_numbers', 'whatsapp_numbers.promotion_id', '=', 'promotions.id')
                                ->whereNotNull('whatsapp_numbers.user_id')
                                ->where('promotions.id', '=', $promotion_id)
                                ->get(['whatsapp_numbers.id'])
                                ->pluck('id');
    }

    /**
     * Get total number of users regitered in promotion
     * @param $promotion_id
     * @return 
     */
    public function usersByPromotion ($promotion_id) 
    {
        return Promotion::join('whatsapp_numbers', 'whatsapp_numbers.promotion_id', '=', 'promotions.id')
                        ->whereNotNull('whatsapp_numbers.user_id')
                        ->count();
    }

    /**
     * Get total number of tickets regitered in promotion
     * @param $promotion_id
     * @return int $tickets 
     */
    public function ticketsByPromotion ($promotion_id) : int 
    {
        $whatsapp_ids = $this->getWhatsappIdsInPromotion($promotion_id); 
        // dd($whatsapp_ids);
        return Ticket::whereIn('whatsapp_id', $whatsapp_ids)->count();
    }

    /**
     * Get total messages recived or sent in promotion
     * @param $promotion_id
     * @return int $messages
     */
    public function messagesByPromotion ($promotion_id, $status) : int 
    {
        return MessageLog::whereStatus($status)
                            ->count();
    }

    /**
     * Get Promotion Temporalities
     * @param int $promotion_id
     * @return $temporalities
     */
    public function getPromotionTemporalities (int $promotion_id) 
    {
        return Temporality::wherePromotionId($promotion_id)
                            ->whereFinalized(0)
                            ->get();
    }

    /**
     * Update Ticket Validation Metrics
     * @param int $country_id
     * @param string $ticket_validation_metrics
     * @return void
     */
    public function updateTicketValidationMetrics (int $promotion_id, string $ticket_validation_metrics) : void 
    {
        Promotion::whereId($promotion_id)
                ->update([
                            'ticket_validation_metrics' => $ticket_validation_metrics
                        ]);
    }

    /**
     * Activates or Deactives a promotion
     * @param int $promotion_id, 
     * @param bool $status
     * @return promotion $promotion
     */
    public function switchActivePromotion (int $promotion_id, bool $status) 
    {
        return Promotion::whereId($promotion_id)
                    ->update([
                            'active' => $status
                        ]);
    }
}