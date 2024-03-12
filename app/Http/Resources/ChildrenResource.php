<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildrenResource extends JsonResource
{
    public $lang;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'id'=>$this->id,
           'name' =>$this->name,
            'email'=>$this->email,
            'date_birth'=>$this->date_birth,
            'gender'=>$this->gender,
            'level_name'=>$this->level_name,
            'class_name'=>$this->class_name,
            'term'=>$this->term,
            'created_at'=>$this->created_at,
        ];
    }
}
