<?php

namespace App\Models;

use App\Traits\CustomiseDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory,CustomiseDateTrait;
    protected $guarded=[];

    public function class()
    {
        return $this->belongsTo(Classe::class,'class_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class,'attachmentable');
    }
    public function attachment()
    {
        return $this->morphOne(Attachment::class,'attachmentable');
    }
}
