<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestQuote extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = !empty($this->data['product_name']) 
            ? 'Quote Request for: ' . $this->data['product_name']
            : 'New Quote Request - ' . $this->data['subject'];

        return $this->subject($subject)
                    ->view('emails.basic-quote')
                    ->with(['data' => $this->data]);
    }
}