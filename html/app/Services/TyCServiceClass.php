<?php

namespace App\Services;

use App\Services\AbstractClasses\StatusAbstract;

class TyCServiceClass extends StatusAbstract
{
    public function getResponse($language, $user_id, $user_response, $image_url) {
        if (in_array($user_response, ['si', 'sí', 'sÍ'])) {
            $this->updateUserStatus($user_id, 5);
            
            $messages = [];
            $messages[] = config('bot_messages.' . $language . '.empezar_registro');
            $messages[] = config('bot_messages.' . $language . '.correo_solicitar');

            return $messages;
        }
        
        return [config('bot_messages.' . $language . '.tyc_rechazado')];
    }
}