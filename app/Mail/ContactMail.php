<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactAuthor;
    public $contactMessage;

    public function __construct($newAuthor, $newMessage)
    {
        $this->contactAuthor = $newAuthor;
        $this->contactMessage = $newMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('contacts@fraqtop.ru')
            ->view('mail.contact');
    }
}
