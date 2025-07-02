<?php

namespace App\Jobs;

use App\Events\EmailSignatarioEvent;
use App\Models\Processos;
use App\Models\Signatarios;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailSignatarioJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $processos;
    public $signatario;
    /**
     * Create a new job instance.
     */
    public function __construct(Processos $processos, Signatarios $signatario)
    {
        $this->processos = $processos;
        $this->signatario = $signatario;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new EmailSignatarioEvent($this->processos, $this->signatario));
    }
}
