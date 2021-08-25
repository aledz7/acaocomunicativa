<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\News;
use App\Models\Health;
use App\Models\Video;
use App\Models\Boletim;

class CallEdit extends Component
{
	public $search;
    public $type;
	public $typeName;
	public $listing;
	public $list;
	public $call;

	public function mount($type)
	{
		$this->type = $type;

		if( $this->type == 'news')
		{
			$this->call = News::where('call',1)->first();
            $this->typeName = 'Notícias';
		}
        if( $this->type == 'video')
        {
            $this->call = Video::where('call',1)->first();
            $this->typeName = 'Video';
        }
        if( $this->type == 'health')
        {
            $this->call = Health::where('call',1)->first();
            $this->typeName = 'Health';
        }
	}

    public function render()
    {
        return view('livewire.call-edit');
    }

    public function listing()
    {

    	if( $this->type == 'news')
    	{
    		$this->list = News::where('title','like','%'.$this->search.'%')->get();
    	}
    	if( $this->type == 'video')
    	{
    		$this->list = Video::where('title','like','%'.$this->search.'%')->get();
    	}
    	if( $this->type == 'health')
    	{
    		$this->list = Health::where('title','like','%'.$this->search.'%')->get();
    	}

    	


    }

    public function makeCall($call)
    {
    	if( $this->type == 'news')
    	{
    		News::where('call',1)->update(['call'=>0]);
    		$newCall = News::find($call);
    		$newCall->call = 1;
    		$newCall->save();
    	}

    	if( $this->type == 'video')
    	{
    		Video::where('call',1)->update(['call'=>0]);
    		$newCall = Video::find($call);
    		$newCall->call = 1;
    		$newCall->save();
    	}

    	if( $this->type == 'health')
    	{
    		Health::where('call',1)->update(['call'=>0]);
    		$newCall = Health::find($call);
    		$newCall->call = 1;
    		$newCall->save();
    	}

    	$this->list = false;
    	$this->call = $newCall;
    }
}
	