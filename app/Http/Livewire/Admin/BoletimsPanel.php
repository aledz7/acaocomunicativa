<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Boletim;
use App\Models\Newsletter;
use App\Mail\SendNews;
use Mail;

class BoletimsPanel extends Component
{
	use WithPagination;

	public $search;
    public $send_to = [];
	public $countSendTo;
    public $boletimsLetterList;

	public $sortDirection = 'desc';
	public $sortField = 'date';

	public function mount()
    {
        $this->boletimsLetterList = \DB::table('newsletters')->select('profession')->groupBy('profession')->pluck('profession')->toArray();
    }

    public function render()
    {
        return view('livewire.admin.boletims-panel',[
            'boletims'=>Boletim::where('title','like','%'.$this->search.'%')
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
        $news = Boletim::find($id);
        $emails = Newsletter::whereIn('profession',$this->send_to)->pluck('email')->toArray();
        Mail::send( new SendNews($news,$emails,'boletim') );

    }


    public function removeAll()
    {
        Boletim::truncate();
    }
}
