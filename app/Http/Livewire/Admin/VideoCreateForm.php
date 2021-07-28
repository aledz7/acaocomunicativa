<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Support\Str;

class VideoCreateForm extends Component
{
	use WithFileUploads;

	public $title;
	public $slug;
	public $date;
	public $short_text;
	public $link;
	public $cover;

    public $categories = [];
    public $newCategory;
    public $categoriesList;
    public $manageCategories;

	protected $rules = [
        'title' => 'required',
        'date' => 'required',
        'link' => 'required',
        'slug' => 'required',
        'short_text' => 'required',
        'cover'=>'required|mimes:jpg,jpeg,png,bmp,tiff |max:1024',
    ];

    protected $messages = [
        'title.required' => 'Campo obrigatório',
        'date.required' => 'Campo obrigatório',
        'file.required' => 'Campo obrigatório',
        'slug.required' => 'Campo obrigatório',
        'short_text.required' => 'Campo obrigatório',
    ];

    protected $listeners = [
        'refreshCategoriesList'=>'refreshCategoriesList'
    ];

    public function mount()
    {
        $this->categoriesList = Category::where('type','like','video')->get();
        $this->date = date('Y-m-d');
    }

    public function updatedCover()
    {
        $this->validate(
            [
                'cover'=>'required|mimes:jpg,jpeg,png,bmp,tiff |max:1024'
            ],
            [
                'cover.required'=>'Campo obrigatório',
                'cover.mimes'=>'Apenas imagens são permitidas, como: jpg,jpeg,png,bmp,tiff',
                'cover.max'=>'Coloque imagens com menos de 1MB. É importante para o desempenho do site',
            ]);
    }

	public function updatedLink($value,$name)
    {
        $this->link = explode('&', str_replace('watch?v=','embed/',$this->link) )[0];
    }

    public function updatedTitle()
    {
    	$this->slug = Str::slug($this->title,'-');
    }

    public function render()
    {
        return view('livewire.admin.video-create-form');
    }

    public function save()
    {
    	$this->validate();

    	$video = new Video;
    	$video->user_id = auth()->user()->id;
    	$video->title = $this->title;
    	$video->short_text = $this->short_text;
    	$video->date = $this->date;
    	$video->slug = $this->slug;
    	$video->link = $this->link;
    	$video->save();

    	if( $this->cover )
    	{
    	    $fileExt = $this->cover->getClientOriginalExtension();
    	    $fileName = Str::slug($this->title, '-');
    	    $video->cover = $this->cover->storeAs('covers',$fileName.'.'.$fileExt,'public');
    	    $video->save();
    	}
        
        $video->categories()->sync($this->categories);

    	return redirect()->route('admin.videos');
    }

    public function refreshCategoriesList()
    {
        $this->categoriesList = Category::where('type','like','video')->get();
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
            'type'=>'video',
            'slug'=>Str::slug($this->newCategory, '-')
        ]);

        $this->newCategory = '';
        $this->categoriesList = Category::where('type','like','video')->get();

        $this->emitUp('refreshCategoriesListManager');
    }

    public function removeCategory($id)
    {
        Category::where('id',$id)->delete();
        $this->categoriesList = Category::where('type','like','video')->get();

        $this->emit('refreshCategoriesList');
    }
}
