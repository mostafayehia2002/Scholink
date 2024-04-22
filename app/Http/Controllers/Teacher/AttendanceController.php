<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassTeacher;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function index()
    {
        $data=Attendance::paginate(20);
//        return $data;
        return view('Teacher.attendance.index', compact('data'));
    }

    public function showAbsence($class_id)
    {
//        $data = Student::where('class_id', $class_id)->get();
        $data=Attendance::paginate(20);
        return view('Teacher.attendance.absence', compact('data', 'class_id'));
    }

    public function absence(Request $request)
    {
        return $request;
    }
}
