<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Level extends Model
{
    use HasFactory , HasTranslations,CustomiseDateTrait;
    public $translatable =['level_name'];
    protected $fillable=['level_number','level_name'];

    public function classes()
    {
        return $this->hasMany(Classe::class,'level_id');
    }

    public function students()
    {

        return $this->hasManyThrough(Student::class,Classe::class,'level_id','class_id');
    }

    protected $casts=[
        'level_name'=>'array',
    ];
}
