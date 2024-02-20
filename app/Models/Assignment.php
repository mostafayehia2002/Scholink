<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory,CustomiseDateTrait;

    protected $guarded=[];

    protected function task(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => asset($value),
        );

    }
        public function class()
    {
        return $this->belongsTo(Classe::class);
    }

    public function homeworks()
    {
        return $this->hasMany(HomeWork::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}
