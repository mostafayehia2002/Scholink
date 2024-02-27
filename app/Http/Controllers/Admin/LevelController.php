<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
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
        $data=Level::paginate(10);
        return view('Admin.levels',compact('data'));
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
                "level_number"=>"required|numeric",
            ]);
            Level::create([
                'level_name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'level_number'=>$request->level_number,
            ]);
            return redirect()->back()->with('success', 'Success Addedd Level');
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
            $level=Level::findOrFail($id);
            $request->validate([
                'name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                "name_en" => ["required", "regex:/^[a-zA-Z ]+/"],
                "level_number"=>"required|numeric",
            ]);
          $level->update([
              'level_name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
              'level_number'=>$request->level_number,
          ]);
            return redirect()->back()->with('success', 'Success Updated Level');
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
            Level::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Success Deleted Level');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
