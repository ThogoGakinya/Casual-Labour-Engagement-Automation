<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CashApproval extends Mailable
{
    use Queueable, SerializesModels;
    public $user_name;
    public $to_approve;
    public $budgeto_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($to_approve, $user_name, $budgeto_name)
    {
        $this->to_approve = $to_approve;
        $this->user_name = $user_name;
        $this->budgeto_name = $budgeto_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('approval_mails.HODmail');
    }
}
