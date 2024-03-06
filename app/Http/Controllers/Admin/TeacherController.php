<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public  function  __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Teacher::paginate(15);
        return view('Admin.teachers',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            $request->validate([
                'name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                "name_en" => ["required", "regex:/^[a-zA-Z ]+/"],
                'email'=>"required|email|unique:teachers,email",
                'phone'=>"required|string|unique:teachers,phone",
                'address'=>"required|max:255",
            ]);
            Teacher::create([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'password'=>bcrypt('123456'),
            ]);
            return redirect()->back()->with('success', 'Success Added Teacher');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $teacher=Teacher::findOrFail($id);
            $request->validate([
                'name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                "name_en" => ["required", "regex:/^[a-zA-Z ]+/"],
                'email'=>"required|email|unique:teachers,email,".$id,
                'phone'=>"required|string|unique:teachers,phone,".$id,
                'address'=>"required|max:255",
            ]);
            $teacher->update([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
            ]);
            return redirect()->back()->with('success', 'Success Update Teacher');
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
            Teacher::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Success Deleted Teacher');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
