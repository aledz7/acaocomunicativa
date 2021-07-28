<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boletim extends Model
{
    use HasFactory;

    public function getDateDisplayAttribute()
    {
        return date('d/m/Y',strtotime($this->date));
    }
}
