<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use App\Models\Assignment;
use App\Models\Classe;
use App\Models\HomeWork;
use App\Models\Student;
use App\Models\Subject;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    //
    use GeneralResponse;

    public function getStudentSubjects()
    {
        try {
            $user=auth('student')->user();
            $class=Classe::with('subjects')->where('id',$user->class_id)->first();
            return  $this->data(200,'class',SubjectResource::make($class));
        }catch (\Exception $e){
            return  $this->error(500,$e->getMessage());
        }

    }

    public function getStudentAssignments(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'subject_id'=>'required|exists:subjects,id',
                ]);
            if ($validate->fails()) {
                return $this->error(422,$validate->errors());
            }
            $user=auth('student')->user();
           $assignments=Assignment::where('subject_id',$request->subject_id)
               ->where('class_id',$user->class_id)
               ->whereDate('deadline','>=',date('Y-m-d'))
               ->orderBy('created_at','desc')
               ->get();
            return  $this->data(200,'assignments',$assignments);
        }catch (\Exception $e){
            return  $this->error(500,$e->getMessage());
        }

    }
}
