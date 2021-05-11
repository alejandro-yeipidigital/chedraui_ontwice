<?php

namespace App\Mails;

use App\Models\Participation;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ValidTicket extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $participation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Participation $participation)
    {
        $this->user = $user;
        $this->participation = $participation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tu ticket ha sido validado con éxito')->view('emails.tickets.valid');
    }
}