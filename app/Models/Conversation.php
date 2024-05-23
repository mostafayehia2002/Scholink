<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Conversation extends Model
{
    use HasFactory, HasTranslations;
    public $translatable =['name'];
   protected  $guarded=[];


    public function participant()
    {
        return $this->morphTo();
    }



    public function  teacher()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function message(){

        return $this->hasOne(Message::class);
}
}
