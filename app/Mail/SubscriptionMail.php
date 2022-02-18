<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $domain;
    public $team;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($team,$user, $domain)
    {        
        $this->team = $team;
        $this->user = $user;
        $this->domain = $domain;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from Matrimonial-assist')
            ->markdown('emails.subscription.expiring_subscription');
    }
}
