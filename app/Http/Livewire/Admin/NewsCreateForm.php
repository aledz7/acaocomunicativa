<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;

class NewsCreateForm extends Component
{
	use WithFileUploads;

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
    public $type;

	protected $rules = [
		'title'=>'required',
		'slug'=>'required',
		'date'=>'required',
		'cover'=>'required|mimes:jpg,jpeg,png,bmp,tiff |max:1024',
		'short_text'=>'required',
		'text'=>'required'
	];

    protected $messages = [
        'title.required'=>'Campo obrigatório',
        'slug.required'=>'Campo obrigatório',
        'date.required'=>'Campo obrigatório',
        'cover.required'=>'Campo obrigatório',
        'cover.mimes'=>'Apenas imagens são permitidas, como: jpg,jpeg,png,bmp,tiff',
        'cover.max'=>'Coloque imagens com menos de 1MB. É importante para o desempenho do site',
        'short_text.required'=>'Campo obrigatório',
        'text.required'=>'Campo obrigatório'
    ];

    protected $listeners = [
        'refreshCategoriesList'=>'refreshCategoriesList'
    ];

	public function mount( $type = null )
	{
		$this->categoriesList = Category::where('type','like','news')->get();
        $this->date = date('Y-m-d');
        $this->type = $type;
	}

	
    public function render()
    {
        return view('livewire.admin.news-create-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function refreshCategoriesList()
    {
        $this->categoriesList = Category::where('type','like','news')->get();
    }

    public function updatedTitle()
    {
    	$this->slug = Str::slug($this->title,'-');
    }

    public function save()
    {
    	$this->validate();
    	$news = new News;
    	$news->user_id = auth()->user()->id;
    	$news->title = $this->title;
    	$news->slug = $this->slug;
    	$news->date_to_save = $this->date;
    	$news->short_text = $this->short_text;
    	$news->text = $this->text;
    	$news->save();

    	if( $this->cover )
        {
            $fileExt = $this->cover->getClientOriginalExtension();
            $fileName = Str::slug($news->title, '-');
            $news->cover = $this->cover->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $news->save();
        }

        $news->categories()->sync($this->categories);
    	
    	return redirect()->route('admin.news');

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


}
