<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use function Laravel\Prompts\select;

class SubCategory extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $fillable=['name','category_id','photo'];
    protected $hidden=['pivot'];

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset("$value"),

        );
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }



    //return news
    public function news()
    {
        return $this->belongsToMany(Category::class,'news','subcategory_id')->select('news.id','news.admin_id','news.title','news.content','news.created_at','news.updated_at');
    }


    //return  announcements
    public function announcements()
    {
        return $this->belongsToMany(Category::class,'announcements','subcategory_id')->select('announcements.id','announcements.admin_id','announcements.price','announcements.photo','announcements.created_at','announcements.updated_at');
    }
}
