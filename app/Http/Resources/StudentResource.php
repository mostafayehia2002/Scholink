<?php

namespace App\Http\Resources;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
      $level=  Level::find($this->classe->level_id)->first();
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'date_birth'=>$this->date_birth,
            'gender'=>$this->gender,
            'level_name'=>$level->level_name,
            'level_number'=>$level->level_number,
            'class_name'=>$this->classe->class_name,
            'photo'=>$this->photo,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
