<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Video;
use App\Models\Newsletter;
use App\Mail\SendNews;
use Mail;

class VideosPanel extends Component
{
	use WithPagination;

	public $search;
    public $send_to = [];
	public $countSendTo;
    public $videosLetterList;

	public $sortDirection = 'desc';
	public $sortField = 'date';

    public function mount()
    {
        $this->videosLetterList = \DB::table('newsletters')->select('profession')->groupBy('profession')->pluck('profession')->toArray();
    }

    public function render()
    {
        return view('livewire.admin.videos-panel',[
            'videos'=>Video::where('title','like','%'.$this->search.'%')
                ->orderBy($this->sortField,$this->sortDirection)->paginate(10)
        ]);
    }

    public function sortOf($field)
    {
        $this->sortDirection = 
            $this->sortField === $field ? 
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            :'asc';

        $this->sortField = $field;
    }

    public function updatedSendTo($value)
    {
        $this->countSendTo = Newsletter::whereIn('profession',$this->send_to)->count();
    }

    public function sendTo($id)
    {
        $news = Video::find($id);
        $emails = Newsletter::whereIn('profession',$this->send_to)->pluck('email')->toArray();
        Mail::send( new SendNews($news,$emails,'video') );

    }


    public function removeAll()
    {
        Video::truncate();
    }
}
