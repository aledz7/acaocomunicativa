<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class NewsCover extends Component
{
	use WithFileUploads;

	public $image;
	public $obj;

    public function render()
    {
        return view('livewire.news-cover');
    }
}
