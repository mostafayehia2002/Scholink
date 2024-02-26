<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    private $array=[];
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $i=0;
        foreach ($this->subjects as $subject){
             $this->array[$i++]=['subject_id'=>$subject->id,'subject_name'=>$subject->name];
        }
        return [
            'level_number'=>$this->level->level_number,
            'level_name'=> $this->level->level_name,
            'class_name'=> $this->class_name,
             'subjects'=>$this->array,
        ];
    }
}
