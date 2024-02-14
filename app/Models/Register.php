<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Register extends Model
{
    use HasTranslations,SoftDeletes,CustomiseDateTrait;
    public $translatable =['parent_name','child_name'];

    protected $table = 'register';
    protected $fillable = [
        'parent_name',
        'parent_email',
        'parent_mobile',
        'parent_data_birth',
        'parent_personal_identification',
        'parent_national_id',
        'parent_address',
        'parent_job',
        'parent_gender',
        'child_name',
        'child_date_birth',
        'child_birth_certificate',
        'child_gender',
        'child_level',
        'child_school_name',
        'message_otp',
        'status'
    ];
    protected $casts=[
        'parent_name'=>'array',
        'child_name'=>'array'
    ];


//    public function getParentNameAttribute($value)
//    {
//    $arr= json_decode($value,true);
//        return    $arr[app()->getLocale()];
//
//    }
//
//    public function getChildNameAttribute($value)
//    {
//        $arr= json_decode($value,true);
//
//        return    $arr[app()->getLocale()];
//
//    }


}
