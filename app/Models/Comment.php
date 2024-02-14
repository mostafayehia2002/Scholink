<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $guarded=[];
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function commentable()
    {
       return $this->morphTo();
    }
}
