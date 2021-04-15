<?php

namespace App\Repositories;

use App\Models\{MessageLog};

class MessageLogRepository 
{
    /**
     * Stores a new message in DB
     * @param required $user_id Whatsapp Id, 
     * @param required $account_id Account Id, 
     * @param required $body Body Message, 
     * @param nullable $media Media, 
     * @param required $message_sid, 
     * @param required $status Message
     * @return void
     */
    public function createMessageLog($temporality_id, $user_id, $account_id, $body, $media, $message_sid, $status) : void {
        $message = new MessageLog;
        $message->temporality_id = $temporality_id;
        $message->user_id    = $user_id;
        $message->account_id     = $account_id;
        $message->body           = $body;
        $message->media          = $media;
        $message->message_sid    = $message_sid;
        $message->status         = $status;
        $message->save();
    }

    /**
     * Delete User Message Logs
     * @param int $user_id
     * @return void
     */
    public function deleteUserMessages(int $user_id) : void {
        MessageLog::whereUserId($user_id)->delete();
    }
}