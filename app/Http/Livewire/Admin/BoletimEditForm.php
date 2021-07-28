<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

use App\Models\Boletim;

class BoletimEditForm extends Component
{
	use WithFileUploads;

	public $boletim;
	public $newCover;
	public $newFile;

	protected $rules = [
		'boletim.title' => 'required',
		'boletim.date' => 'required',
		'boletim.file' => 'required',
		'boletim.short_text' => 'required',
	];

	protected $messages = [
		'boletim.title.required' => 'Campo obrigatório',
		'boletim.date.required' => 'Campo obrigatório',
        'boletim.file.required' => 'Campo obrigatório',
        'boletim.short_text.required' => 'Campo obrigatório',
	];

    public function render()
    {
        return view('livewire.admin.boletim-edit-form');
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
        $this->newCover = null;
    }

    public function save()
    {
    	$this->validate();

    	$this->boletim->save();

    	if( $this->newFile )
    	{

    	    $fileExtension = $this->newFile->getClientOriginalExtension();
    	    $fileName = Str::slug($this->boletim->title,'-');
    	    $this->boletim->file = $this->newFile->storeAs('boletim',$fileName.'.'.$fileExtension,'public');
    	    $this->boletim->save();
    	}
    	if( $this->newCover)
    	{
           
    	    $fileExt = $this->newCover->getClientOriginalExtension();
    	    $fileName = Str::slug($this->boletim->title, '-');
    	    $this->boletim->cover = $this->newCover->storeAs('covers',$fileName.'.'.$fileExt,'public');
    	    $this->boletim->save();
    	}
    	return redirect()->route('admin.boletims');
    }
}
