<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=['name','description','logo','number_seats'];
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
}
