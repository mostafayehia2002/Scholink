<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use Illuminate\Support\Facades\App;

class WeekDay extends Enum implements LocalizedEnum
{
    const SUNDAY='sunday';
    const MONDAY='monday';
    const TUESDAY='tuesday';
    const WEDNESDAY='wednesday';
    const THURSDAY='thursday';
    const FRIDAY='friday';
    const SATERDAY='saterday';

    public static function getTranslatedDay($day, $language)
    {
        return trans('enums.week_days.'.$day,[], $language);
    }

}
