<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $lang=app()->getLocale();
        return [
            'name'=>$this->name[$lang],
            'email'=>$this->email,
            'date_birth'=>$this->date_birth,
            'gender'=>$this->gender,
            'level'=>$this->classe['level'],
            'class_name'=>$this->classe['class_name'],
            'photo'=>$this->photo,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
