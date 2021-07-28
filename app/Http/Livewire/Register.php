<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
	public $name;
    public $email;
	public $whatsapp;
	public $password;
	public $password_confirmation;
	public $check = [];
	public $freeToGo = false;
	public $alert;

	protected $rules = [
        'name'=>'required|min:4',
		'whatsapp'=>'required',
		'email'=>'required|email|unique:users',
		'password'=>'required|confirmed',
	];

	protected $messages = [
		'name.required'=>'Campo nome é obrigatório',
		'name.min'=>'Digite um nome válido',
        'whatsapp.required'=>'Whatsapp é obrigatório',
		'email.required'=>'E-mail é obrigatório',
		'email.email'=>'Digite um e-mail válido',
		'password.required'=>'Digite uma senha',
		'password.confirmed'=>'A confirmação de senha não bate',
	];

    public function render()
    {
        return view('livewire.register');
    }

    public function updatedPassword($value)
    {
    	$this->freeToGo = false;

    	$this->check['min'] = (strlen($value) >= 8) ? true : false;
    	$this->check['number'] = preg_match("#[0-9]+#", $value) ? true : false;
    	$this->check['uppercase'] = preg_match("#[A-Z]+#", $value) ? true : false;
    	$this->check['lowercase'] = preg_match("#[a-z]+#", $value) ? true : false;

    	if( !in_array(false, $this->check) ) $this->freeToGo = true;

    }
  
    public function register()
    {
    	if( $this->freeToGo == false ) return $this->alert = 'Senha não atende aos critérios mínimos';
    	$this->validate();


    	$user = User::create([
    		'name'=>$this->name,
    		'email'=>$this->email,
    		'password'=>bcrypt($this->password),
    		'role_id'=>2
    	]);



        if (Auth::attempt(['email'=>$this->email, 'password'=>$this->password ])) 
        {
            return redirect()->route('boletims');
            $this->alert = 'Cadastro realizado';
            
        }
        else
        {
        	$this->alert = 'Houve algum erro, tente novamente mais tarde';
        }

    }

}
