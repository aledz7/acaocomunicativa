<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Video;
use App\Models\News;
use App\Models\Health;
use App\Mail\SendNewsTo;
use Mail;


class SendToMail extends Component
{

    public $title;
    public $short_text;
    public $status;
    public $type;
    public $post_id;

    public $to;
    public $by_name;
    public $by_email;
    public $comments;

    protected $rules = [
        'to'=>'required',
        'by_name'=>'required',
        'by_email'=>'required',
    ];

    public function updatedTo($value)
    {
        $this->validate([
            'to'=>'required|email'
        ]);
    }

    public function updatedByEmail($value)
    {
        $this->validate([
            'by_email'=>'required|email'
        ]);
    }

    public function send()
    {
        $this->validate();

        if( $this->type == 'news' )
        {
            $post = News::find( $this->post_id );  
        }

        if( $this->type == 'video' )
        {
            $post = Video::find( $this->post_id );  
        }

        if( $this->type == 'health' )
        {
            $post = Health::find( $this->post_id );  
        }


        $from = [
            'name'=>$this->by_name,
            'email'=>$this->by_email,
        ];

        Mail::send( new SendNewsTo($post,$this->to,$from,$this->comments) );
        $this->status = 'Enviado! Muito obrigado =)';
    }

    public function render()
    {
        return view('livewire.send-to-mail');
    }
}
