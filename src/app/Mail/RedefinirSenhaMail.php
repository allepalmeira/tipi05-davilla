<?php

namespace App\Mail;

use App\Models\Cliente;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class RedefinirSenhaMail extends Mailable
{
    public function __construct(
        public Cliente $cliente,
        public string $codigo,
        public int $validadeMinutos = 5
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Seu código de verificação - Confeitaria DaVilla');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.redefinir-senha');
    }
}
