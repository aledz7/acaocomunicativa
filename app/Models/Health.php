<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Health extends Model
{
    use HasFactory;

    protected $fillable = ['title','date','short_text','cover','text','user_id'];


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('published',function (Builder $builder) {
            $builder->where('date', '<=', date('Y-m-d 23:59:59'));
        });
    }

    

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getCoverImgAttribute()
    {
        return $this->cover == null ? '/img/no-image.png' : asset('/storage/'.$this->cover);
    }

    public function setDateToSaveAttribute($value)
    {
        $this->attributes['date'] = $value.' '.date('H:i:s');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateDisplayAttribute()
    {
        return date('d/m/Y',strtotime($this->date));
    }
}
