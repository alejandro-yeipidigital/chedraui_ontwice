<?php

namespace App\Repositories;

use App\Models\{User, WhatsappNumber};

class UsersRepository 
{
    /**
     * Find user
     * @param int $user_id
     * @return User $user
     */
    public function findUser(int $user_id) {
        return User::find($user_id);
    }

    /**
     * Retrive Whatsapp Number by User
     * @param int $user_id
     * @return object $wa_number 
     */
    public function getUserWhatsappNumber(int $user_id) {
        $user = $this->findUser($user_id);

        return $user->wa_number;
    }

    /**
     * Obtain Promotion in which the user is participating
     * @param int $user_id
     * @return int $promotion_id
     */
    public function getPromotionByUser(int $user_id) : int {
        $user = $this->findUser($user_id);

        return $user->wa_number->promotion_id;
    }

    /**
     * Verify is user already exists in a promotion
     * @param int $country_id
     * @param string $email
     * @return $user
     */
    public function emailExistsInPromotion(int $country_id, string $email) {
        return User::whereCountryId($country_id)
                    ->whereEmail($email)
                    ->whereActive(1)
                    ->first();
    }
}