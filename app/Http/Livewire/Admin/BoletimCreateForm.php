<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Boletim;
use Illuminate\Support\Str;

class BoletimCreateForm extends Component
{
	use WithFileUploads;

	public $title;
	public $date;
	public $short_text;
	public $file;
	public $cover;

	protected $rules = [
		'title' => 'required',
		'date' => 'required',
        'file' => 'required',
        'cover'=>'required|mimes:jpg,jpeg,png,bmp,tiff |max:1024',
		'short_text' => '',
	];

	protected $messages = [
		'title.required' => 'Campo obrigatório',
		'date.required' => 'Campo obrigatório',
		'file.required' => 'Campo obrigatório',
	];

	public function mount()
	{
		$this->date = date('Y-m-d');
	}

    public function render()
    {
        return view('livewire.admin.boletim-create-form');
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

    public function save()
    {
    	$this->validate();

    	$boletim = new Boletim;
    	$boletim->user_id = auth()->user()->id;
    	$boletim->title = $this->title;
    	$boletim->short_text = $this->short_text;
    	$boletim->date = $this->date;
    	$boletim->save();

    	if( $this->file )
    	{
    	    $fileExtension = $this->file->getClientOriginalExtension();
    	    $fileName = Str::slug($this->title,'-');
    	    $boletim->file = $this->file->storeAs('boletim',$fileName.'.'.$fileExtension,'public');
    	    $boletim->save();
    	}
    	if( $this->cover )
    	{
    	    $fileExt = $this->cover->getClientOriginalExtension();
    	    $fileName = Str::slug($this->title, '-');
    	    $boletim->cover = $this->cover->storeAs('covers',$fileName.'.'.$fileExt,'public');
    	    $boletim->save();
    	}

    	return redirect()->route('admin.boletims');
    }
}
