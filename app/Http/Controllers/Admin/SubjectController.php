<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
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
        $data = Subject::paginate(10);
        return view('Admin.subjects', compact('data'));
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
        try{

            $request->validate([
                'name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                "name_en" => ["required", "regex:/^[a-zA-Z ]+/"],
            ]);
            Subject::create([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
            ]);
            return redirect()->back()->with('success',__('subjects.s_add_subject'));
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
            $subject=Subject::findOrFail($id);
            $request->validate([
                'name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                "name_en" => ["required", "regex:/^[a-zA-Z ]+/"],
            ]);
            $subject->update([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
            ]);
            return redirect()->back()->with('success', __('subjects.s_update_subject'));
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
            Subject::findOrFail($id)->delete();
            return redirect()->back()->with('success', __('subjects.s_delete_subject'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
