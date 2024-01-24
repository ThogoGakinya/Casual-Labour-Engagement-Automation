<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyCasualsApprovalRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $requisition_details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requisition_details)
    {
        $this->requisition_details = $requisition_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('DCEmails.DailyCasualsApproval');
    }
}
