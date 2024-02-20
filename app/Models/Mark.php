<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mark extends Model
{
    use HasFactory,CustomiseDateTrait;

    protected $fillable=['term','marks','level','tasks','months','subject_grade','total_marks'];
 protected  $table='student_marks';
    public function students():belongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function subjects():belongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
