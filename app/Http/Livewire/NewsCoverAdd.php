<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class NewsCoverAdd extends Component
{
	use WithFileUploads;

	public $image;
	
    public function render()
    {
        return view('livewire.news-cover-add');
    }
}
