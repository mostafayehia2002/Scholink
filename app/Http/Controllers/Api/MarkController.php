<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarksResource;
use App\Models\Classe;
use App\Models\Mark;
use App\Models\Student;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarkController extends Controller
{
use GeneralResponse;
public function getStudentMarks(Request $request)
{
    try {
        $validate = Validator::make(
            $request->all(),
            [
               'level_id'=>'required|exists:levels,id',
                'term'=>'required|in:first,second'
            ]);
        if ($validate->fails()) {
            return $this->error(422,$validate->errors());
        }
          $student=auth('student')->user();
         $marks=Mark::with('subject')
             ->where('student_id',$student->id)
             ->where('level_id',$request->level_id)
             ->where('term',$request->term)
             ->get();
        return $this->data(200,'marks',MarksResource::collection($marks));
    }catch (\Exception $e){
        return $this->error(500,$e->getMessage());
    }

}
}
