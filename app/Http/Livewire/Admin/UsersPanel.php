<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UsersPanel extends Component
{
	public $search;
	public $editUser;
	public $status;

	public $name;
	public $email;
	public $role_id;

	protected $messages = [
		'editUser.name.required'=>'O Nome é obrigatório',
		'editUser.email.required'=>'O E-mail é obrigatório',
		'editUser.email.email'=>'Coloque um e-mail válido',
		'editUser.email.unique'=>'Já existe um outro usuário com esse e-mail'
	];


	protected $listeners = ['refreshUsersTable'=>'$refresh'];

	public function rules()
	{
		return $rules = [
			'editUser.name'=>'required',
			'editUser.email'=>'required|email|unique:users,email,'.$this->editUser->id,
		];

	}

    public function render()
    {
        return view('livewire.admin.users-panel',[
        	'users'=>User::orderBy('name')
        				->where('name','like','%'.$this->search.'%')
        				->where('role_id','!=',2)
        				->paginate(10)
        ]);
    }


    public function edit($id)
    {
    	$this->status = '';
    	$this->editUser = User::find($id);
    }

    public function updateUser()
    {
    	$this->validate();

        $this->editUser->role_id = 1;
    	$this->editUser->save();

    	$this->status = 'Atualizado!';
    }

    public function removeUser()
    {
    	$id = $this->editUser->id;
    	User::where('id',$id)->delete();
    }
}
