<?php

namespace App\Mail;

use App\Models\Technician;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $technician, $token;

    /**
     * Create a new message instance.
     *
     * @param Technician $technician
     */
    public function __construct(Technician $technician, $token)
    {
        $this->technician = $technician;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password-reset')->subject(__('password_reset.subject'));
    }
}
