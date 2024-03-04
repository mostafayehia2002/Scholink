<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssignmentsGradeResource;
use App\Http\Resources\MonthExamsResource;
use App\Http\Resources\SubjectResource;
use App\Models\Assignment;
use App\Models\Classe;
use App\Models\HomeWork;
use App\Models\Student;
use App\Models\Subject;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    //
    use GeneralResponse;

    public function getStudentSubjects()
    {
        try {
            $student=auth('student')->user();
            $class=Classe::with(['subjects','level'])->where('id',$student->class_id)->first();
           //SubjectResource::make($class)
            return  $this->data(200,'class',SubjectResource::make($class));
        }catch (\Exception $e){
            return  $this->error(500,$e->getMessage());
        }

    }

    public function getAssignments(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'subject_id' => 'required|exists:subjects,id',
                'status'=>'required|in:incoming,past-due,completed'
            ]);
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $status=$request->status;
            $now= date('Y-m-d');
            $student = auth('student')->user();
            //get assignment
            $query = Assignment::where('subject_id', $request->subject_id)
                ->where('class_id', $student->class_id);
            switch ($status) {
                case 'incoming':
                    $assignments =$query
                        ->whereDate('deadline', '>=', $now)
                        ->orderBy('created_at','desc')
                        ->get();
                    break;
                case 'past-due':
                    $assignments = $query
                        ->whereDate('deadline', '<', $now)
                        ->whereDoesntHave('homeworks', function ($query) use ($student) {
                            $query->where('student_id', $student->id);
                        })
                        ->orderBy('created_at','desc')
                        ->get();
                    break;
                case 'completed':
                    $assignments = $query
                        ->whereHas('homeworks', function ($query) use ($student) {
                            $query->where('student_id', $student->id)->where('status','accept');
                        })
                        ->orderBy('created_at','desc')
                        ->get();
                    break;
            }
            return $this->data(200, 'assignments', $assignments);
        } catch (\Exception $e) {
            return $this->error(500, $e->getMessage());
        }
    }

    public function uploadHomework(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'assignment_id' => 'required|exists:assignments,id',
                 'homework'=>'required|mimes:jpeg,png,jpg,pdf,docx'
            ]);
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $student=auth('student')->user();
            $checkStudent=HomeWork::where('student_id',$student->id)
                ->where('assignment_id',$request->assignment_id)
                ->first();
            if($checkStudent){
                return $this->error(422,trans('response.Assignment_Already_Uploaded'));
            }
            $homework =time().$request->file('homework')->getClientOriginalName();
            $request->file('homework')->storeAs('/', $homework, 'student');
            $student->assignments()->attach([$request->assignment_id=>['homework'=>"uploads/students/$homework"]]);
            return $this->successMessage(201, trans('response.Successfully_Uploaded_Homework'));
        }catch (\Exception $e){
            return $this->error(500, $e->getMessage());
        }
    }


    public function getAssignmentsGrade(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'subject_id' => 'required|exists:subjects,id',
            ]);
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
             $student=auth('student')->user();
            $data=$student->assignments->where('subject_id',$request->subject_id);
            return  $this->data(200,'tasks',AssignmentsGradeResource::collection($data));
        }catch (\Exception $e){
            return $this->error(500, $e->getMessage());
        }
    }

    public function getMonthExamsGrade(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'subject_id' => 'required|exists:subjects,id',
            ]);
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $student=auth('student')->user();
            $data=$student->monthExams->where('subject_id',$request->subject_id);
            if(count($data)>0) {
                return $this->data(200, 'months', MonthExamsResource::collection($data));
            }else{
                return  $this->error(404,trans('response.Data_Not_Found'));
            }
        }catch (\Exception $e){
            return $this->error(500, $e->getMessage());
        }
    }



}
