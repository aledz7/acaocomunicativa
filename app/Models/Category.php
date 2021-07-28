<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','type','slug'];

    public function news()
    {
    	return $this->belongsToMany(News::class);
    }

    public function videos()
    {
    	return $this->belongsToMany(Video::class);
    }
}
