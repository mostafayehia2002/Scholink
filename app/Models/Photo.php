<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $guarded=[];
    protected $hidden=['id','photoble_type','photoble_id','created_at','updated_at'];
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset("$value"),

        );
    }
    public function photoble()
    {
        return $this->morphTo();
    }
}
