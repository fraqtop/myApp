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
    public $errorTrace;
    /**
     * Create a new message instance.
     * @param string newErrorContent
     * @param array $newErrorTrace
     * @return void
     */
    public function __construct(string $newErrorMessage, array $newErrorTrace)
    {
        $this->errorMessage = $newErrorMessage;
        $this->errorTrace = $newErrorTrace;
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
