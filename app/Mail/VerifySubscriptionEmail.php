<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifySubscriptionEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email-templates/verify-subscription-email')
            ->subject('Verify your subscription email')
            ->from(['address' => 'do-not-reply@malayaholidays.com', 'name' => 'Malaya Holidays'])
            ->with('email', $this->email);
    }
}
