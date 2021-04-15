<?php

namespace App\Services;

use App\Services\AbstractClasses\StatusAbstract;

class AgeServiceClass extends StatusAbstract
{
    public function getResponse($language, $whatsapp_id, $user_response, $image_url) {
        if (in_array($user_response, ['si', 'sí', 'sÍ'])) {
            $this->updateUserStatus($whatsapp_id, 4);
            
            $messages[] = config('bot_messages.' . $language . '.tyc_solicitar');

            return $messages;
        }
        
        return [config('bot_messages.' . $language . '.edad_rechazado')];
    }
}