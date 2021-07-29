<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SponsorshipMail extends Mailable
{
    use Queueable, SerializesModels;
    public $argument;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($argument)
    {
        $this->argument = $argument;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.sponsorship')->subject('sottoscrizione sponsorizzazione' . $this->argument['sponsorship']->name);
    }
}
