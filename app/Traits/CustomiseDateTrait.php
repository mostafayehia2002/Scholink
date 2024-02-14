<?php

namespace App\Traits;

trait CustomiseDateTrait
{
    public function getCreatedAtAttribute($value)
    {

        return date('Y-M-d h:i A', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {

        return date('Y-M-d h:i A', strtotime($value));
    }

}
