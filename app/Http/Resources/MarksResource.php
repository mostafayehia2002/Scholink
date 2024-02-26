<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
           'subject_name'=>$this->subject->name,
            'tasks'=>$this->tasks,
            'months'=>$this->months,
            'subject_grade'=>$this->subject_grade,
            'total_marks'=>$this->total_marks,
            'created_at'=>$this->created_at,
        ];
    }
}
