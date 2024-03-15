<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;

class GuidelineController extends Controller
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
        $category=Category::whereJsonContains('name->en','guidelines')->first();
        $data=$category->contents()->latest()->paginate(20);
        return view('Admin.media.guidelines',compact('data'));
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
        try {
            $validator=Validator::make($request->all(),['content'=>'required|string']);
            $category=Category::whereJsonContains('name->en','guidelines')->first();
            $data=$validator->validated();
            $data['admin_id']=auth()->user()->id;
            $category->contents()->create($data);
            return  redirect()->back()->with('success','Success Add Guideline');
        }catch (Exception $e){
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
        try {
            $validator=Validator::make($request->all(),['content'=>'required|string']);
            $guideline=Content::find($id);
            $guideline->update($validator->validated());
            return  redirect()->back()->with('success','Success Update Guideline');
        }catch (Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $guideline=Content::findOrFail($id);
            $guideline->delete();
            return  redirect()->back()->with('success','Success Delete Guideline');
        }catch (Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
