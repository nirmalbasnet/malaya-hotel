<?php

namespace App\Mail;

use App\BackendModel\Destination;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InquiryAlert extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $destination = Destination::find($data['destination_id']);
        return $this->markdown('email-templates/inquiry-alert')
            ->subject('Inquiry for destination '.$destination->title)
            ->from(['address' => 'do-not-reply@malayaholidays.com', 'name' => 'Malaya Holidays'])
            ->with('data', $data)
            ->with('destination', $destination);
    }
}
