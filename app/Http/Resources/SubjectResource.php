<?php

namespace App\Http\Resources;

use App\Models\Subject;
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
             $this->array[$i++]=['subject_id'=>$subject->id,'subject_name'=>trans("subject.$subject->name"),'term'=>$subject->term,'created_at'=>$subject->created_at];
        }
        return [
            'level_number'=>$this->level,
            'level_name'=> trans("level.$this->level"),
            'class_name'=> $this->class_name,
            'created_at'=>$this->created_at,
             'subjects'=>$this->array,
        ];
    }
}
