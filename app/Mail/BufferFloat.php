<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BufferFloat extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $amount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($amount, $user_name)
    {
        $this->amount = $amount;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('approval_mails.BufferFloat');
    }
}
