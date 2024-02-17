<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
    use HasFactory;
    protected $fillable=['content','category_id','admin_id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }



    public function comments():hasMany
    {
        return $this->hasMany(Comment::class,'content_id');
    }

    public function reactions():hasMany
    {
        return $this->hasMany(Reaction::class,'content_id');
    }


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

}
