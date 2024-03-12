<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use App\Models\Classe;
use App\Models\Student;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
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
            if (count($class->table)) {
                $groupedSchedules = $class->table->groupBy('day')->map(function ($schedules, $day) {
                    return ['day' => $day, 'schedules' => $schedules->map->only('subject', 'number_lesson', 'start_at', 'end_at')];
                })->values();
                return  $this->data(200, 'table', TableResource::collection($groupedSchedules));
            }
            return $this->errorMessage(404, trans('response.Data_Not_Found'));
        } catch (Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }
    }

    public function getTable(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'student_id' => 'required|exists:students,id',
            ]);
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $student = Student::find($request->student_id);

            $class = Classe::with(['table' => function ($query) {
                $query->with('subject:id,name');
            }])->where('id', $student->class_id)->first();
            if (count($class->table)) {
                $groupedSchedules = $class->table->groupBy('day')->map(function ($schedules, $day) {
                    return ['day' => $day, 'schedules' => $schedules->map->only('subject', 'number_lesson', 'start_at', 'end_at')];
                })->values();
                return  $this->data(200, 'table', TableResource::collection($groupedSchedules));
            }
            return $this->errorMessage(404, trans('response.Data_Not_Found'));
        } catch (Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }
    }
}
