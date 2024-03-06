<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Mark extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $fillable=['term','marks','level_id','tasks','months','subject_grade','total_marks'];
 protected  $table='student_marks';

    public function student():belongsTo
    {
        return $this->belongsTo(Student::class);
    }

    //done
    public function subject():belongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
