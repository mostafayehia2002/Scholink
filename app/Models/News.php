<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $guarded=[];

    public function photos()
    {
        return $this->morphMany(Photo::class,'photoble');
    }
    public function photo()
    {
        return $this->morphOne(Photo::class,'photoble');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
