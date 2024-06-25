<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Colaborador;

class RecuperarPasswordColaboradorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $colaborador;


    public function __construct(Colaborador $colaborador)
    {
        $this->colaborador = $colaborador;
    }

    public function build()
    {            
        return $this->view('mail.recuperar-password-colaborador');
    }
}
