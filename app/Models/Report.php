<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['title','date','cover','file'];

    public function getDateDisplayAttribute()
    {
        return date('d/M/Y',strtotime($this->date));
    }

    public function getCoverImageAttribute()
    {
        $image =  \Storage::url($this->cover);
        return "<img src=". $image .">";
    }
}
