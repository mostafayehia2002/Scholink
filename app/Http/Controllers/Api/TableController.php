<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use App\Models\Classe;
use App\Traits\GeneralResponse;
use PHPUnit\Exception;

class TableController extends Controller
{
    use GeneralResponse;
    public function getStudentTable()
    {
        try {
            $student = auth('student')->user();
            $class = Classe::with(['table' => function ($query) {
                $query->with('subject:id,name');
            }])->where('id', $student->class_id)->first();
            if(count($class->table)){
                $groupedSchedules = $class->table->groupBy('day')->map(function ($schedules, $day) {
                    return ['day' => $day, 'schedules' => $schedules->map->only('subject','number_lesson','start_at','end_at')];
                })->values();
                return  $this->data(200,'table',TableResource::collection($groupedSchedules));
             }
            return $this->error(404,trans('response.Data_Not_Found'));
        }catch (Exception $e){
            return $this->error(500,$e->getMessage());
        }

    }
}
