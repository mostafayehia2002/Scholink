<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use CustomiseDateTrait;

    use HasFactory;
    protected  $guarded=[];
    public function sender()
    {
        return $this->morphTo();
    }
}
