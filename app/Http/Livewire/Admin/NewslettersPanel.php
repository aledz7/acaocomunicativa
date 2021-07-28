<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Newsletter;
use App\Exports\NewsletterExport;
use Maatwebsite\Excel\Facades\Excel;

class NewslettersPanel extends Component
{
    use WithPagination;
	use WithFileUploads;

    public $search;
    public $numbers = [];
	public $importBase;
	public $sortDirection = 'asc';
	public $sortField = 'name';


    public function render()
    {
        return view('livewire.admin.newsletters-panel',[
            'newsletters'=>Newsletter::where('name','like','%'.$this->search.'%')
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

    public function checkBase()
    {
        $this->numbers = [];

        if( $this->importBase != null )
        {

            $this->importBase->storeAs('public/base','checking-base.csv');
            
            $i = 0;

            if ( ($handle = fopen( 'storage/base/checking-base.csv' , "r") ) !== FALSE) {
                

                $check = file( 'storage/base/checking-base.csv' ); 
                $separator           = [];
                $separator[';']      = count( explode( ';' , $check[1] ) );
                $separator[',']      = count( explode( ',' , $check[1] ) );
                $separator['\t']     = count( explode( '\t' , $check[1] ) );

                $delimiter           = array_search( max($separator), $separator);

                $pavimento = '';
                while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                    $i++;
                    if( $i == 1 ) continue;
                    @$this->numbers['newsletters'] += 1;
                    @$this->numbers['professions'][$data[2]] += 1;
                }

                fclose($handle);
            }
        }
    }

    public function saveBase()
    {

        if( $this->importBase != null )
        {

            $this->importBase->storeAs('public/base','checking-base.csv');
            
            $i = 0;

            if ( ($handle = fopen( 'storage/base/checking-base.csv' , "r") ) !== FALSE) {
                

                $check = file( 'storage/base/checking-base.csv' ); 
                $separator           = [];
                $separator[';']      = count( explode( ';' , $check[1] ) );
                $separator[',']      = count( explode( ',' , $check[1] ) );
                $separator['\t']     = count( explode( '\t' , $check[1] ) );

                $delimiter           = array_search( max($separator), $separator);

                $newsletters = [];
                while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                    $i++;
                    if( $i == 1 ) continue;
                    $newsletters[] = [
                        'name'=>$data[0],
                        'email'=>$data[1],
                        'profession'=>$data[2],
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                    ];
                }

                fclose($handle);
            }

            Newsletter::insert($newsletters);

        }
    }


    public function exportTable()
    {
        
        $newsletter = Newsletter::where('name','like','%'.$this->search.'%')
                ->orderBy($this->sortField,$this->sortDirection)->get();

        return Excel::download(new NewsletterExport($newsletter), ' Base de Newsletter - Ação comunicativa.xlsx');

    }


}
