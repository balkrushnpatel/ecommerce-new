<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void 

    /**
     * Build the message.
     *
     * @return $this
     */ 
    public function __construct($message){
         $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $messageData = $this->message;
        $from_email = $messageData['email_id'];
        $name = $messageData['name'];
        
       return $this->from($from_email,$name )->subject($messageData['subject'])->view('mail.contact-us')->with('contactUs', $messageData);
    }
}
