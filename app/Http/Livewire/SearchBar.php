<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\News;
use App\Models\Video;

class SearchBar extends Component
{
	public $search;

    public function render()
    {
        return view('livewire.search-bar',[
        	'videos'=> \DB::table('videos')->where('title','like','%'.$this->search.'%')->get()->take(5),
        	'news'=> \DB::table('news')->where('title','like','%'.$this->search.'%')->get()->take(5)
        ]);
    }

}
