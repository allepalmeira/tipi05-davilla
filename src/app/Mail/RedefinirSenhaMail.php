<?php

namespace App\Mail;

use App\Models\Cliente;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class RedefinirSenhaMail extends Mailable
{
    public string $url;

    public function __construct(public Cliente $cliente, string $token)
    {
        $this->url = route('senha.redefinir', [
            'token' => $token,
            'email' => $cliente->email_cliente,
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Redefinição de senha - Confeitaria DaVilla');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.redefinir-senha');
    }
}
