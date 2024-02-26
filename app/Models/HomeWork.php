<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeWork extends Model
{
    use HasFactory;
    protected $guarded=[];
   protected  $table='homeworks';
    //done
    public function assignments()
    {
        return $this->belongsTo(Assignment::class,'assignment_id');
    }
}
