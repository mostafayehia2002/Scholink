<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

class Material extends Enum implements LocalizedEnum
{
    const SUNDAY='lesson';
    const MONDAY='exam';
    const TUESDAY='video';

    public static function getTranslatedDay($type, $language)
    {
        return trans('enums.material_type.'.$type,[], $language);
    }
}
