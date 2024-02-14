<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $fillable=['name'];



//
    public function teacher(): belongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function assignments():hasMany
    {

        return $this->hasMany(Assignment::class);
    }
    public function attendances():hasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function marks():hasMany
    {
        return $this->hasMany(Mark::class);
    }
}
