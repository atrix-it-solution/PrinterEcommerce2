<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $quoteData;

    /**
     * Create a new message instance.
     */
    public function __construct($quoteData)
    {
        $this->quoteData = $quoteData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = !empty($this->quoteData['product_name']) 
            ? 'Quote Request for: ' . $this->quoteData['product_name']
            : 'New Quote Request - ' . $this->quoteData['subject'];

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.simple-quote',
            with: [
                'name' => $this->quoteData['name'],
                'email' => $this->quoteData['email'],
                'phone' => $this->quoteData['phone'],
                'subject' => $this->quoteData['subject'],
                'message' => $this->quoteData['message'],
                'product_id' => $this->quoteData['product_id'] ?? null,
                'product_name' => $this->quoteData['product_name'] ?? null,
                'product_price' => $this->quoteData['product_price'] ?? null,
                'product_url' => $this->quoteData['product_url'] ?? null,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}