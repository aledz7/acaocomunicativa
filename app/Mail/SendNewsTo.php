<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewsTo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($news,$emails,$from,$comments)
    {
        //
        $this->news = $news;
        $this->emails = $emails;
        $this->from = $from;
        $this->comments = $comments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->emails)
                    ->subject(config('app.name'). ' - '. $this->news->title)
                    ->from('contato@acaocomunicativa.com.br')
                    ->markdown('emails.send-news-to',['news'=>$this->news,'from'=>$this->from,'comments'=>$this->comments]);
    }
}
