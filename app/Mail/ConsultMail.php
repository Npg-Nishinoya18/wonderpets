<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ConsultMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //dd($data);
        $this->data = $data;
        // dd($this->data['sender']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   //hatdogmalala@gmail.com
        //return $this->view('mail')->with('data', $this->data);

        //dd($this->data);
         return $this->from('administrator@bands.ph')->subject('Consultation Result')->view('consultmail')->with('data', $this->data);
        //return $this->from($this->data->sender)->subject($this->data->title)->view('mail')->with('data', $this->data);
        //return $this->from($this->data['sender'])->subject($this->data['title'])->view('mail')->with('data', $this->data);
    }
}
