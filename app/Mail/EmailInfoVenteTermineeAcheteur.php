<?php

namespace App\Mail;

use App\Good;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailInfoVenteTermineeAcheteur extends Mailable
{
    use Queueable, SerializesModels;

    protected $good;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Good $good)
    {
        $this->good = $good;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array(
            "good" => $this->good
        );
        return $this->from("projetdevweb.siteencheres@gmail.com", "Site d'enchères")
            ->view('emails.InfoVenteTermineeAcheteur', $data);
    }
}
