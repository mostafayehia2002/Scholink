<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function photos()
    {
        return $this->morphMany(Photo::class,'photoble');
    }
    public function photo()
    {
        return $this->morphOne(Photo::class,'photoble');
    }
}
