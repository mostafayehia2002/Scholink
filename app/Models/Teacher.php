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

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,CustomiseDateTrait;
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

    public function subject():hasOne
    {
        return $this->hasOne(Subject::class);
    }
    public function  classes(): belongsToMany
    {
        return $this->belongsToMany(Classe::class,'class_teacher');
    }

    public function assignments():hasMany
    {

        return $this->hasMany(Assignment::class);
    }
}
