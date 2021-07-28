<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title','short_text','link','user_id','cover','date'];

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function getDateDisplayAttribute()
    {
        return date('d/m/Y',strtotime($this->date));
    }
}
