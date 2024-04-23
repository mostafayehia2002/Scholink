<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Level;
use App\Models\ParentStudent;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $levels=Level::all();
        $classe='';
        if($request->has('class_id')){
            $classe=Classe::findOrFail($request->class_id);
            $leval=$classe->level->id;
        }
        $data=Student::where(function ($query)use($request){
            if($request->has('class_id')){
                $query->where('class_id',$request->class_id);
            }
        })->paginate(10);
        return view('Admin.students.index',compact('data','classe','levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $parents=ParentStudent::all();
            $levels=Level::all();
            $student=Student::findOrFail($id);
            return view('Admin.students.edit',compact('student','parents','levels'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{



            $request->validate([
                'name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                "name_en" => ["required", "regex:/^[a-zA-Z ]+/"],
                'email'=>"required|email|unique:students,email,".$id,
                'parent_id'=>"required|exists:parents,id",
                'level_id'=>"required|exists:levels,id",
                'class_id'=>"required|exists:classes,id",
                'term'=>"required|in:first,second",
                'gender'=>"required|in:male,female",
                'date_birth'=>'required',
            ]);
            $student=Student::findOrFail($id);
            if($student->date_birth!=$request->date_birth){
                $request->date_birth = Carbon::createFromFormat('d F, Y', $request->date_birth)->format('Y-m-d');
            }

            $student->update([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'email'=>$request->email,
                'parent_id'=>$request->parent_id,
                'class_id'=>$request->class_id,
                'term'=>$request->term,
                'gender'=>$request->gender,
                'date_birth'=>$request->date_birth,
            ]);
            return redirect()->back()->with('success', __('students.s_update_student'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Student::findOrFail($id)->delete();
            return redirect()->back()->with('success', __('students.s_delete_student'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
