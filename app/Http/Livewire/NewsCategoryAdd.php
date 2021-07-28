<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;

class NewsCategoryAdd extends Component
{
	public $addCategory;
	public $newCategory;
    public $type;

    public function mount($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.news-category-add',[
        	'categories'=>Category::where('type',$this->type)->orderBy('name')->get()
        ]);
    }

    public function saveCategory()
    {
    	$this->validate([
    		'newCategory'=>'required',
    	]);

    	$this->validate([
    		'newCategory.required'=>'Coloque o nome da categoria',
    	]);

    	$category = Category::updateOrCreate([
            'name'=>$this->newCategory,
    		'type'=>$this->type,
            'slug'=>Str::slug($this->newCategory, '-')
    	]);


    	$this->addCategory = false;
    	$this->newCategory = '';
    	$this->category = $category->id;
    }
}
