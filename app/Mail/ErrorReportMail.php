<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ErrorReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $errorMessage;
    public $errorFile;
    /**
     * Create a new message instance.
     * @param string newErrorContent
     * @param string $newErrorFile
     * @return void
     */
    public function __construct(string $newErrorMessage, string $newErrorFile)
    {
        $this->errorMessage = $newErrorMessage;
        $this->errorFile = $newErrorFile;
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
            ->view('mail.error-report');
    }
}
