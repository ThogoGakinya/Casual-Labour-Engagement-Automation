<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;
    public $password;
    public $user_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password, $user_email)
    {
        $this->password = $password;
        $this->user_email = $user_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('approval_mails.PasswordReset');
    }
}
