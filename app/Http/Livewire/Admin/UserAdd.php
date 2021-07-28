<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Mail;
use App\Mail\WelcomeUser;

class UserAdd extends Component
{
	public $user;
	public $status;

	protected $rules = [
			'user.name'=>'required',
			'user.email'=>'required|email|unique:users,email',
		];

	protected $messages = [
		'user.name.required'=>'O Nome é obrigatório',
		'user.email.required'=>'O E-mail é obrigatório',
		'user.email.email'=>'Coloque um e-mail válido',
		'user.email.unique'=>'Já existe um outro usuário com esse e-mail'
	];

	public function mount()
	{
		$this->user = new User;
	}

    public function render()
    {
        return view('livewire.admin.user-add');
    }

    public function addUser()
    {

    	$this->validate();

    	$password = substr( bcrypt(time()), '10','8') ;

    	$this->user->role_id = 1;
    	$this->user->password = bcrypt($password);
    	$this->user->save();

    	$this->emit('refreshUsersTable');

    	Mail::send( new WelcomeUser($this->user,$password));

    	$this->user = new User;
    	$this->status = 'Usuário criado';
    }
}
