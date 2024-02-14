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

    public function teachers(): belongsToMany
    {
        return $this->belongsToMany(Teacher::class,'class_teacher');
    }

    public function assignments():hasMany
    {

        return $this->hasMany(Assignment::class);
    }

    public function attendances():hasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
