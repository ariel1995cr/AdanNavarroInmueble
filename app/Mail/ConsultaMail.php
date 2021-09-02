<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombrePublicacion;
    public $nombreApellido;
    public $telefono;
    public $horario;
    public $comentario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombrePublicacion, $nombreApellido, $telefono, $horario, $comentario)
    {
        //
        $this->nombrePublicacion = $nombrePublicacion;
        $this->nombreApellido = $nombreApellido;
        $this->telefono = $telefono;
        $this->horario = $horario;
        $this->comentario = $comentario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nueva consulta realizada')
            ->view('emails.consultaMail');
    }
}
