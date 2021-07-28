<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Video;

class VideoEditForm extends Component
{
	use WithFileUploads;

	public $video;
	public $newCover;
    public $newFile;
	public $iframe;

    public $categories = [];
    public $newCategory;
    public $categoriesList;
    public $manageCategories;


	protected $rules = [
		'video.title' => 'required',
		'video.date' => 'required',
        'video.link' => 'required',
		'video.slug' => 'required',
		'video.short_text' => 'required',
	];

	protected $messages = [
		'video.title.required' => 'Campo obrigatório',
		'video.date.required' => 'Campo obrigatório',
        'video.file.required' => 'Campo obrigatório',
        'video.slug.required' => 'Campo obrigatório',
		'video.short_text.required' => 'Campo obrigatório',
	];

    protected $listeners = [
        'refreshCategoriesList'=>'refreshCategoriesList'
    ];

    public function mount()
    {
        $this->categoriesList = Category::where('type','like','video')->get();
        $this->categories = $this->video->categories->pluck('id')->map(fn($id) => (string) $id)->toArray();
    }

    public function render()
    {
        return view('livewire.admin.video-edit-form');
    }

    public function updatedNewCover()
    {
        $this->validate(
            [
                'newCover'=>'required|mimes:jpg,jpeg,png,bmp,tiff |max:1024'
            ],
            [
                'newCover.required'=>'Campo obrigatório',
                'newCover.mimes'=>'Apenas imagens são permitidas, como: jpg,jpeg,png,bmp,tiff',
                'newCover.max'=>'Coloque imagens com menos de 1MB. É importante para o desempenho do site',
            ]);
    }

    public function updatedVideoTitle($value,$name)
    {
        $this->video->slug = Str::slug($this->video->title,'-');
    }

    public function updatedVideoLink($value,$name)
    {
        $this->video->link = explode('&', str_replace('watch?v=','embed/',$this->video->link) )[0];
        $this->iframe = $this->video->link;
    }

    public function save()
    {
    	$this->validate();
    	$this->video->save();

    	if( $this->newFile )
    	{
    	    $fileExtension = $this->newFile->getClientOriginalExtension();
    	    $fileName = Str::slug($this->video->title,'-');
    	    $this->video->file = $this->newFile->storeAs('video',$fileName.'.'.$fileExtension,'public');
    	    $this->video->save();
    	}
    	if( $this->newCover)
    	{
            $this->validate(
                [
                    'newCover'=>'required|mimes:jpg,jpeg,png,bmp,tiff |max:1024'
                ],
                [
                    'newCover.required'=>'Campo obrigatório',
                    'newCover.mimes'=>'Apenas imagens são permitidas, como: jpg,jpeg,png,bmp,tiff',
                    'newCover.max'=>'Coloque imagens com menos de 1MB. É importante para o desempenho do site',
                ]);
    	    $fileExt = $this->newCover->getClientOriginalExtension();
    	    $fileName = Str::slug($this->video->title, '-');
    	    $this->video->cover = $this->newCover->storeAs('covers',$fileName.'.'.$fileExt,'public');
    	    $this->video->save();
    	}

        $this->video->categories()->sync($this->categories);

    	return redirect()->route('admin.videos');
    }

    


}
