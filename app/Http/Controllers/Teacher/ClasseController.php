<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassTeacher;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }
    public  function index(){
        $data=ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->paginate(20);
        return view('Teacher.classes',compact('data'));
    }
}
