<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
	public $user;
	public $alert;

	protected $rules = [
		'user.email'=>'required',
		'user.password'=>'required',
	];

	protected $messages = [
		'user.email.required'=>'E-mail é obrigatório',
		'user.password.required'=>'Senha é obrigatório',
	];

    public function render()
    {
        return view('livewire.login');
    }

    public function login()
    {
    	$this->validate();


    	if (Auth::attempt(['email'=>$this->user['email'], 'password'=>$this->user['password']])) 
        {
            return redirect()->route('boletims');
        }
        else
        {
        	$this->alert = 'Os dados não correspondem';
        }
    }
}
