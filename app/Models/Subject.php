<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory,HasTranslations,CustomiseDateTrait;
    public $translatable =['name'];
    protected $fillable=['name'];
    public function assignments()
    {
        return $this->belongsToMany(Subject::class,'assignments','subject_id')->withPivot('title','task','grade','deadline');
    }

    protected $casts=[
        'name'=>'array',
    ];

}
