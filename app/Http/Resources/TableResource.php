<?php

namespace App\Http\Resources;

use App\Enums\WeekDay;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class TableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected $array=[];

    public function toArray($request)
    {
        $i=0;
        foreach ($this['schedules'] as $schedules){
            $this->array[$i++]=[
                'subject'=>$schedules['subject']->name,
                'number_lesson'=>$schedules['number_lesson'],
                'start_at'=>$schedules['start_at'],
                'end_at'=>$schedules['end_at'],
                ];
        }

        return [
            'day' =>$this['day'],
            'schedules'=>$this->array
        ];
    }
}
