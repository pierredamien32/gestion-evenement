<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmRegistration extends Mailable
{
    use Queueable, SerializesModels;

    
    public $user;

    /**
     * Create a new message instance.
     *
     * @param  User  $user
     * @return void
     */

     public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('albathsaada3@gmail.com')
        ->subject('Felicitations')
        ->view('confirmRegistration')
        ->with([
            'user' => $this->user,
        ]);
    }
}
