<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\SendNewsTo;
use App\Models\News;
use Mail;

class SendNewsMail extends Component
{
	public $news;
	public $status;

	public $to;
	public $by_name;
	public $by_email;
	public $comments;

	protected $rules = [
		'to'=>'required',
		'by_name'=>'required',
		'by_email'=>'required',
	];

    public function render()
    {
        return view('livewire.send-news-mail');
    }

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
        $news = News::find($this->news->id);

        $from = [
        	'name'=>$this->by_name,
        	'email'=>$this->by_email,
        ];

        Mail::send( new SendNewsTo($news,$this->to,$from,$this->comments) );
    	$this->status = 'Enviado! Muito obrigado =)';
    }
}
