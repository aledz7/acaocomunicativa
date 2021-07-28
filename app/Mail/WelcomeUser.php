<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
        //
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->to($this->user->email)
                ->bcc('kleber.souza@anewcon.com.br')
                ->subject('Ação Comunicativa - Você foi cadastrado como '.$this->user->statusName.' no Portal')
                ->markdown('emails.welcome-user',['user'=>$this->user,'password'=>$this->password]);
    }
}
