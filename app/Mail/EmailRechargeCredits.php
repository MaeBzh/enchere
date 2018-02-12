<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailRechargeCredits extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $credits;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $credits)
    {
        $this->user = $user;
        $this->credits = $credits;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array(
            "user" => $this->user,
            "credits" => $this->credits
        );
        return $this->from("projetdevweb.siteencheres@gmail.com", "Site d'enchères")
            ->view('emails.rechargeCredits', $data);
    }
}
