<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @method static create(array[] $array)
 */
class Subject extends Model
{
    use HasFactory,HasTranslations,CustomiseDateTrait;
    public $translatable =['name'];
    protected $fillable=['name'];
    public function assignments()
    {
        return $this->belongsToMany(Subject::class,'assignments','subject_id')->withPivot('title','task','grade','deadline');
    }
    public function materials()
    {
        return $this->hasMany(Material::class,'subject_id');
    }
    protected $casts=[
        'name'=>'array',
    ];

}
