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
    public $contactFeedback;

    public function __construct($newAuthor, $newMessage, $newFeedback)
    {
        $this->contactAuthor = $newAuthor;
        $this->contactMessage = $newMessage;
        $this->contactFeedback = $newFeedback;
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
