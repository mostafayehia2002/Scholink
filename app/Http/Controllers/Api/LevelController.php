<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;
use App\Models\Level;
use App\Models\Student;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    use GeneralResponse;

    public function getLevels()
    {
        try {
            $levels = Level::get();
            return  $this->data(200, 'levels', LevelResource::collection($levels));
        } catch (\Exception $e) {
            return $this->error(500, $e->getMessage());
        }
    }

    public function getStudentLevels()
    {
        try {
            $student = auth('student')->user();
            $levels = Level::where('id', '<=', $student->classe->level_id)->get();
            if (count($levels) < 0) {
                return $this->error(404, trans('response.Data_Not_Found'));
            }
            return $this->data(200, 'data', LevelResource::collection($levels));
        } catch (\Exception $e) {
            return $this->error(500, $e->getMessage());
        }
    }


    //get student level to parent
    public function getLevel(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'student_id' => 'required|exists:students,id',
                ]
            );
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $student = Student::find($request->student_id);
            $levels = Level::where('id', '<=', $student->classe->level_id)->get();
            if (count($levels) < 0) {
                return $this->error(404, trans('response.Data_Not_Found'));
            }
            return $this->data(200, 'data', LevelResource::collection($levels));
        } catch (\Exception $e) {
            return $this->error(500, $e->getMessage());
        }
    }
}
