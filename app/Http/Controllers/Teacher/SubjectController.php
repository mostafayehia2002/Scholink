<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassTeacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }
    public  function index(){
        $subjects_id=ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->pluck('subject_id');
        $data=Subject::whereIn('id',$subjects_id)->distinct()->paginate(20);
        return view('Teacher.subjects',compact('data'));
    }
}
