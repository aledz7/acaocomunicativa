<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class NewsCategoriesManager extends Component
{
	public $categoriesList;
	
	protected $listeners = [
        'refreshCategoriesListManager'=>'$refresh'
    ];
	
	public function mount()
	{
        $this->categoriesList = Category::where('type','like','news')->get();
	}

    public function render()
    {
        return view('livewire.admin.news-categories-manager');
    }

    public function removeCategory($id)
    {
        Category::where('id',$id)->delete();
        $this->categoriesList = Category::where('type','like','news')->get();

        $this->emit('refreshCategoriesList');
    }
}
