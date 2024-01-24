<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyCasualApproval extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $total_days;
    public $hod_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $total_days, $hod_data)
    {
        $this->request = $request;
        $this->total_days= $total_days;
        $this->hod_data= $hod_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('DCEmails.DCEApprovals');
    }
}
