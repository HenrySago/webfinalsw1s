<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cliente;

class RecuperarPasswordClienteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;


    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    
    public function build()
    {
        return $this->view('mail.recuperar-password-cliente');
    }
}
