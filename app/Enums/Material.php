<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

class Material extends Enum implements LocalizedEnum
{
    const lesson='lesson';
    const exam='exam';
    const video='video';

    public static function getTranslatedDay($type, $language)
    {
        return trans('enums.material_type.'.$type,[], $language);
    }
}
