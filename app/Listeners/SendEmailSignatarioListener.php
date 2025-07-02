<?php

namespace App\Listeners;

use App\Events\EmailSignatarioEvent;
use App\Mail\EmailSignatarioMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailSignatarioListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(EmailSignatarioEvent $event): void
    {
        Mail::to($event->signatario->email)->send(
            new EmailSignatarioMail([
                'toEmail' => $event->signatario->email,
                'nome' => $event->signatario->nome,
                'idProcesso' => $event->processos->id,
                'idSignatario' => $event->signatario->id,
                'titulo' => $event->processos->titulo,
                'subject' => 'Aprovação de Processo',
            ])
        );
    }
}
