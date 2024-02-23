<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $fillable=['name','term'];
    public function assignments()
    {
        return $this->belongsToMany(Subject::class,'assignments','subject_id')->withPivot('title','task','grade','deadline');
    }


}
