<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRequisition extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $email_type;
    public $to_approve;
    public $user_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $email_type, $to_approve, $user_name)
    {
        $this->request = $request;
        $this->email_type = $email_type;
        $this->to_approve = $to_approve;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('approval_mails.RequisitionMail');
    }
}
