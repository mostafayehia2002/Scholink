<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,CustomiseDateTrait;
    use HasTranslations;
    public $translatable =['name'];
    protected  $fillable=[
        'name',
        'email',
        'phone',
        'address',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function  classes(): belongsToMany
    {
        return $this->belongsToMany(Classe::class,'class_teachers','teacher_id');
    }


}
