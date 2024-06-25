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
use Spatie\Translatable\HasTranslations;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Student extends Authenticatable implements JWTSubject
{
    use HasApiTokens,HasTranslations, HasFactory, Notifiable,CustomiseDateTrait;

    protected $table = 'students';
    public $timestamps = true;
    public $translatable =['name','level_name'];
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
        'term',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'name'=>'array',
        'level_name' => 'array',
    ];

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
    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset("$value"),
        );
    }


    //done
    public function parent()
    {
        return $this->belongsTo(ParentStudent::class);
    }
    //done
    public function classe()
    {
        return $this->belongsTo(Classe::class,'class_id');
    }
    //done
    public function assignments()
    {
        return $this->belongsToMany(Assignment::class,'homeworks','student_id')->withPivot('homework', 'grade','status');
    }
    //done
    public function monthExams()
    {

        return $this->hasMany(MonthExam::class,'student_id');
    }
   //done
    public function marks()
    {
        return $this->hasMany(Mark::class,'student_id');
    }


    public function conversation()
    {
        return $this->morphOne(Conversation::class,'participant');
    }

    public function conversations()
    {
        return $this->morphMany(Conversation::class,'participant');
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
