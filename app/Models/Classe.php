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
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        return $this->hasMany(ClassTeacher::class,'class_id');
    }
    public function subjects()
    {
        return $this->hasMany(ClassTeacher::class,'class_id');
    }

    public function assignments()
    {
        return $this->belongsToMany(Subject::class,'assignments')->withPivot('title','task','grade','deadline');
    }




    public function attendances():hasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
