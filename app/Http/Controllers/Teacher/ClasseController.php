<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\ClassTeacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }
    public  function index(){
        $data=ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->paginate(20);
        return view('Teacher.timetable',compact('data'));
    }
    public  function classes(){
        $ids=ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->distinct()->pluck('class_id');

        $data=Classe::whereIn('id',$ids)->paginate(20);
        return view('Teacher.classes',compact('data'));
    }
    public function students($class_id){
        $data=Student::where('class_id',$class_id)->paginate(20);
        return view('Teacher.students',compact('data'));
    }
}
