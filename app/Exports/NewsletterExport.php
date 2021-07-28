<?php

namespace App\Exports;

use App\Models\Newsletter;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NewsletterExport implements FromView
{
    public function __construct($newsletter)
    {
    	$this->newsletter = $newsletter;
    }

    public function view(): View
    {
        return view('exports.newsletter', [
            'newsletter' => $this->newsletter
        ]);
    }
}
