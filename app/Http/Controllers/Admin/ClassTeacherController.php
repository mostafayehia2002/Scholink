<?php

namespace App\Http\Controllers\Admin;

use App\Enums\WeekDay;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\ClassTeacher;
use App\Models\Level;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassTeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ClassTeacher::paginate(20);
        return view('Admin.class_teachers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $levels = Level::all();
        $days = WeekDay::getValues();
        return view('Admin.class_teachers.create', compact('teachers', 'subjects', 'levels', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'teacher_id' => "required|exists:teachers,id",
                'subject_id' => "required|exists:subjects,id",
                'class_id' => "required|exists:classes,id",
                'day' => "required",
                'number_lesson' => "required|numeric|in:1,2,3",
                'start_at' => "required",
                'end_at' => "required",
            ]);

            $teacher=ClassTeacher::where('teacher_id', $request->teacher_id)
                ->where('subject_id', $request->subject_id)
                ->where('class_id', $request->class_id)
                ->where('start_at', $request->start_at)
                ->where('day',$request->day)
                ->first();
            if ($teacher) {
                return redirect()->back()->with('error', 'Teacher Is Already Exist');
            }
            ClassTeacher::create($validator->validated());
            return redirect()->back()->with('success', 'Success Add Class Teacher');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ClassTeacher::findOrFail($id);
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $levels = Level::all();
        $days = WeekDay::getValues();
        return view('Admin.class_teachers.edit', compact('data', 'teachers', 'subjects', 'levels', 'days'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ClassTeacher::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Success Delete Class Teacher');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function getClass($level_id)
    {
        $classes = Classe::where('level_id', $level_id)->get()->pluck('id', 'class_name');
        return json_encode($classes);
    }

}
