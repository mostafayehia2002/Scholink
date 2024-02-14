<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $lang=app()->getLocale();
        return [
            'name'=>$this->name[$lang],
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'national_id'=>$this->national_id,
            'address'=>$this->address,
            'job'=>$this->job,
            'gender'=>$this->gender,
            'date_birth'=>$this->date_birth,
            'photo'=>$this->photo,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,

        ];
    }
}
