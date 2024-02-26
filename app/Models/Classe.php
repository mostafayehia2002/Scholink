<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
    use SoftDeletes,CustomiseDateTrait;
    protected $table = 'classes';
    protected $fillable = ['level','class_name','number_seats','available_seats'];
    //done
    public function students():hasMany
    {
        return $this->hasMany(Student::class);
    }

    //done
    public function teachers():belongsToMany
    {
        return $this->belongsToMany(Teacher::class,'class_teachers','class_id');
    }

    //done
    public function subjects():belongsToMany
    {
        return $this->belongsToMany(Subject::class,'class_teachers','class_id');
    }
  //done
    public function assignments():belongsToMany
    {
        return $this->belongsToMany(Subject::class,'assignments','class_id')->withPivot('title','task','grade','deadline');
    }


    public function level()
    {
        return $this->belongsTo(Level::class);
    }


}
