<?php

namespace App\Models;

use App\Enums\WeekDay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    use HasFactory;
    protected $table='class_teachers';
    protected $guarded=[];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    protected $casts=[
        'day'=>WeekDay::class,
    ];
}
