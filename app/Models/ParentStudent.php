<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ParentStudent extends Authenticatable implements JWTSubject
{
    use HasApiTokens,HasTranslations, HasFactory, Notifiable, SoftDeletes,CustomiseDateTrait;
    protected $table = 'parents';
    public $timestamps = true;
    public $translatable =['name'];
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'national_id',
        'personal_identification',
        'address',
        'job',
        'gender',
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

    public function students()
    {
        return $this->hasMany(Student::class,'parent_id');
    }
    public function comment()
    {
        return$this->morphOne(Comment::class,'commentable');
    }
    public function comments()
    {
        return$this->morphMany(Comment::class,'commentable');
    }
    public function reaction()
    {
        return$this->morphOne(Reaction::class,'reactable');
    }
    public function reactions()
    {
        return$this->morphMany(Reaction::class,'reactable');
    }

    public function conversation()
    {
        return $this->morphOne(Conversation::class,'participant');
    }

    public function conversations()
    {
         return $this->morphMany(Conversation::class,'participant');
    }

    //to get conversation through conversation model
    public function getTeachersConversations()
    {
        return $this->hasManyThrough(Teacher::class, Conversation::class, 'participant_id', 'id', 'id', 'teacher_id');
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'sender');
    }
    public function message()
    {
        return $this->morphOne(Message::class, 'sender');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
