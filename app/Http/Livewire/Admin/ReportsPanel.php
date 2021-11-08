<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Report;
use Mail;

class ReportsPanel extends Component
{

    use WithPagination, WithFileUploads;

    public $search;
    public $sortDirection = 'desc';
    public $sortField = 'date';

    public $modalAdd = false;
    public $modalEdit = false;

    public $newReportTitle;
    public $newReportDate;
    public $newReportCover;
    public $newReportFile;

    public $reportEdit;

    protected $rules = [
        'newReportTitle'=>'required',
        'newReportDate'=>'required',
        'newReportFile'=>'required',
        'newReportCover'=>'required',
        'reportEdit.title'=>'required',
        'reportEdit.date'=>'required',
        'reportEdit.file'=>'required',
        'reportEdit.cover'=>'required',
    ];


    public function render()
    {
        return view('livewire.admin.reports-panel',[
            'reports'=>Report::where('title','like','%'.$this->search.'%')
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

    public function addReport()
    {
        $this->modalAdd = true;
    }

    public function saveReport()
    {

        $this->validate();

        $file = $this->newReportFile->store('reports','public');
        $cover = $this->newReportFile->store('covers','public');

        $report = new Report;
        $report->added_by_id = auth()->user()->id;
        $report->title = $this->newReportTitle;
        $report->date = $this->newReportDate;
        $report->file = $file;
        $report->cover = $cover;
        $report->save();

    }

    public function editReport( $id )
    {
        $this->reportEdit = Report::find($id);
        $this->modalEdit = true;
    }

    public function updateReport()
    {
        $this->reportEdit->save();
        $this->modalEdit = false;
    }

    public function removeReport()
    {
        $this->modalEdit = false;
        $this->reportEdit->delete();
    }

}
