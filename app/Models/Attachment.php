<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $guarded=[];
    protected $hidden=['id','attachmentable_type','attachmentable_id','created_at','updated_at'];
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
    public function attachmentable()
    {
        return $this->morphTo();
    }
}
