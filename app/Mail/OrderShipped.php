<?php

namespace App\Mail;

use App\Models\Diplome;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
      public $data = [];
    public function __construct(Diplome $diplome)
    {
        $this->data = $diplome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Diplome $diplome)
    {
     
        return $this->markdown('emails.demande');
    }
}