<?php

namespace App\Services\AbstractClasses;

use App\Http\Traits\{UserStatusTrait};
use App\Repositories\{WANumbersRepository};

abstract class StatusAbstract {
    
    use UserStatusTrait;

    /**
     * Get's response and executes the
     * right methods for each Status
     * @param $language, $user_id, $user_response, $image_url
     * @return $message
     */
    abstract public function getResponse($language, $user_id, $user_response, $image_url);
}