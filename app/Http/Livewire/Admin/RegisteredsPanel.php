<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;
use App\Mail\SendNews;
use Mail;

class RegisteredsPanel extends Component
{
	use WithPagination;

	public $search;
	public $sortDirection = 'asc';
	public $sortField = 'name';


    public function render()
    {
        return view('livewire.admin.registereds-panel',[
            'registereds'=>User::where('role_id',2)->where('name','like','%'.$this->search.'%')
                ->orderBy($this->sortField,$this->sortDirection)->paginate(10)
        ]);
    }

    public function sortOf($field)
    {
        $this->sortDirection = 
            $this->sortField === $field ? 
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            :'asc';

        $this->sortField = $field;
    }

}
