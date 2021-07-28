<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNews extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($news,$emails,$type)
    {
        //
        $this->news = $news;
        $this->emails = $emails;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->bcc($this->emails)
                    ->subject(config('app.name'). ' - '. $this->news->title)
                    ->from('contato@acaocomunicativa.com.br')
                    ->markdown('emails.send-news',['news'=>$this->news,'type'=>$this->type]);
    }
}
