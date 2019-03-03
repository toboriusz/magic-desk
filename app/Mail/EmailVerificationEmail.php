<?php

namespace App\Mail;

use App\Models\Technician;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $technician;

    /**
     * Create a new message instance.
     *
     * @param Technician $technician
     */
    public function __construct(Technician $technician)
    {
        $this->technician = $technician;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email-verification')->subject(__('verify_email.subject'));
    }
}
