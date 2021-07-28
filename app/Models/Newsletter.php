<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','profession','whatsapp'];

    public function getDateDisplayAttribute()
    {
        return date('d/m/Y',strtotime($this->created_at));
    }
}
