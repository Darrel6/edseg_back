<?php

namespace App\Mail;

use App\Models\Diplome;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class DiplomeSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data=[];
 
    public function __construct($diplome)
    {
        $file = public_path().$diplome->pdf_diplome;
        $this->data = $file;
         
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::info($this->data);

        return $this->markdown('emails.sendDiplome')->attach($this->data);
    }
}