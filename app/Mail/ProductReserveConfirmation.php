<?php

namespace App\Mail;

use App\Models\Product; //Revisar bien si la ruta es la correcta
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductReserveConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    
    // public function __construct(Product $product)
    // {
    //     $this->product = $product;
        
    // }


    //  Version con CPP
    public function __construct(
        public Product $product,
        ){}


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmacion de reserva del producto',
            from: new Address('No-Responder@oldmoney.com', 'DV-oldmoney')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails/product-reserve-confirmation',
            text: 'emails/product-reserve-confirmation-text'
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
