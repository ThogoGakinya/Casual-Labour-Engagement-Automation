<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyCasual extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $total_days;
    public $email_type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $total_days, $email_type)
    {
        $this->request = $request;
        $this->total_days= $total_days;
        $this->email_type= $email_type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('DCEmails.Approvals');
    }
}
