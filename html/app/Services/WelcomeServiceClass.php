<?php

namespace App\Services;

use App\Services\AbstractClasses\StatusAbstract;
use App\Repositories\{WANumbersRepository, UserRepository};

class WelcomeServiceClass extends StatusAbstract
{
    public function __construct($promotion_id) {
        // $this->userRepository      = new WANumbersRepository;
        $this->userRepository           = new UserRepository;
        $this->promotion_id = $promotion_id;
    }

    public function getResponse($language, $user_id, $user_response, $image_url) 
    {
       if (in_array($user_response, ['si', 'sí', 'sÍ'])) {
            $this->updateUserStatus($user_id, 3);
            
            $messages[] = config('bot_messages.' . $language . '.mayoria_edad_solicitar');

            return $messages;
        }
        
        return [config('bot_messages.' . $language . '.bienvenida_rechazado')];
    }
}