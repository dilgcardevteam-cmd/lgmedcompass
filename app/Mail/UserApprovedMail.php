<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class UserApprovedMail extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Your Account Has Been Approved')
            ->view('emails.user-approved');
    }
}
