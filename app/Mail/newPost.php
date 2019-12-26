<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newPost extends Mailable
{
    use Queueable, SerializesModels;
    public $title,$writer,$id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id,$title,$writer)
    {
        $this->title = $title;
        $this->writer = $writer;
        $this->id = $id;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
                    ->view('mail.newPost');
    }
}
