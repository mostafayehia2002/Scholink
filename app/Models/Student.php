<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Student extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable,CustomiseDateTrait;

    protected $table = 'students';
    public $timestamps = true;
    public $translatable =['name'];
    protected $fillable = [
        'parent_id',
        'name',
        'email',
        'gender',
        'class_id',
        'date_birth',
        'password',
        'message_otp',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'name'=>'array'
    ];

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset("$value"),

        );
    }


    public function parent()
    {
        return $this->belongsTo(ParentStudent::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class,'id');
    }



    public function homeworks()
    {
        return $this->hasMany(HomeWork::class);
    }

    public function comment()
    {
        return$this->morphOne(Comment::class,'commentable');
    }
    public function comments()
    {
        return$this->morphMany(Comment::class,'commentable');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
