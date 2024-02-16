<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use function Laravel\Prompts\text;

class Category extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $fillable=['name'];
    protected $hidden = ['pivot'];


    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    //return news
    public function news()
    {
        return $this->belongsToMany(SubCategory::class,'news','category_id')->select('news.content','news.created_at','news.updated_at');
    }
//return announcements

    public function announcements()
    {
        return $this->belongsToMany(SubCategory::class,'announcements','subcategory_id')
            ->select('announcements.price','announcements.photo','announcements.created_at','announcements.updated_at');
    }
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
