<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class feedbackMail extends Mailable
{
    use Queueable, SerializesModels;
    public $title,$body,$email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$body,$email)
    {
        $this->title = $title;
        $this->body = $body;
        $this->email = $email;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)
                    ->view('mail.feedbackMail');
    }
}
