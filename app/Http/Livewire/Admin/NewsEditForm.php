<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;

class NewsEditForm extends Component
{
	use WithFileUploads;

	public $news;
	public $title;
	public $slug;
	public $date;
	public $cover;
	public $categories = [];
	public $short_text;
	public $text;
	public $newCategory;
    public $categoriesList;
	public $manageCategories;

	protected $rules = [
		'news.title'=>'required',
		'news.slug'=>'required',
		'news.date'=>'required',
		'news.short_text'=>'required',
		'news.text'=>'required'
	];

    protected $messages = [
        'news.title.required'=>'Campo obrigatório',
        'news.slug.required'=>'Campo obrigatório',
        'news.date.required'=>'Campo obrigatório',
        'news.short_text.required'=>'Campo obrigatório',
        'news.text.required'=>'Campo obrigatório'
    ];

    protected $listeners = [
        'refreshCategoriesList'=>'refreshCategoriesList'
    ];

	public function mount()
	{
		$this->categoriesList = Category::where('type','like','news')->get();
        $this->date = date('Y-m-d');
        $this->categories = $this->news->categories->pluck('id')->map(fn($id) => (string) $id)->toArray();
	}

    public function updatedCover()
    {
        $this->validate([
            'cover'=>'required|mimes:jpg,jpeg,png,bmp,tiff |max:1024'
        ]);

        $this->validate([
            'cover.required'=>'Campo obrigatório',
            'cover.mimes'=>'Apenas imagens são permitidas, como: jpg,jpeg,png,bmp,tiff',
            'cover.max'=>'Coloque imagens com menos de 1MB. É importante para o desempenho do site',
        ]);
    }

	
    public function render()
    {
        return view('livewire.admin.news-edit-form');
    }


    public function updatedTitle()
    {
    	$this->slug = Str::slug($this->title,'-');
    }

    public function save()
    {
    	$this->validate();
    	$this->news->save();

    	if( $this->cover )
        {
            $this->validate([
                'cover'=>'required|mimes:jpg,jpeg,png,bmp,tiff |max:1024'
            ]);

            $fileExt = $this->cover->getClientOriginalExtension();
            $fileName = Str::slug($this->news->title, '-');
            $this->news->cover = $this->cover->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $this->news->save();
        }

        $this->news->categories()->sync($this->categories);
    	
    	return redirect()->route('admin.news');

    }

    public function refreshCategoriesList()
    {
        $this->categoriesList = Category::where('type','like','news')->get();
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
    		'type'=>'news',
            'slug'=>Str::slug($this->newCategory, '-')
    	]);

    	$this->newCategory = '';
		$this->categoriesList = Category::where('type','like','news')->get();

        $this->emitUp('refreshCategoriesListManager');
    }

    public function removeCategory($id)
    {
        Category::where('id',$id)->delete();
        $this->categoriesList = Category::where('type','like','news')->get();

        $this->emit('refreshCategoriesList');
    }

    public function remove()
    {
    	$this->news->delete();
    	return redirect()->route('admin.news');
    }


}
