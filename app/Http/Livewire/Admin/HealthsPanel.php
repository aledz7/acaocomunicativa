<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Health;
use App\Models\Newsletter;
use App\Mail\SendNews;
use Mail;

class HealthsPanel extends Component
{

    use WithPagination;

    public $search;
    public $send_to = [];
    public $countSendTo;
    public $newsLetterList;

    public $sortDirection = 'desc';
    public $sortField = 'date';

    public $type;

    public function mount()
    {
        $this->newsLetterList = \DB::table('newsletters')->select('profession')->groupBy('profession')->pluck('profession')->toArray();
    }

    public function render()
    {
        return view('livewire.admin.healths-panel',[
            'healths'=>Health::where('title','like','%'.$this->search.'%')
                ->when( $this->type , function($q) {
                    $q->where('type',$this->type);
                })
                ->orderBy($this->sortField,$this->sortDirection)->withoutGlobalScope('published')->paginate(10)
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
        $health = Health::find($id);
        $emails = Newsletter::whereIn('profession',$this->send_to)->pluck('email')->toArray();
        Mail::send( new SendNews($health,$emails,'news') );

    }


    public function removeAll()
    {
        Health::truncate();
    }
}
