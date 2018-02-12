<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array(
            "token" => $this->token
        );
        return $this->from("projetdevweb.siteencheres@gmail.com", "Site d'enchères")
            ->view('emails.resetPassword', $data);
    }
}
