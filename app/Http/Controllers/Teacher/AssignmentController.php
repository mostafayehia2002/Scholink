<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Assignment::latest()->paginate(20);
        return view('Teacher.assignments.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $level_ids = auth('teacher')->user()->classes->pluck('level_id');
        $levels = Level::whereIn('id', $level_ids)->get();
        return view('Teacher.assignments.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'class_id' => 'required|',
            'subject_id' => 'required',
            'title' => 'required',
            'grade' => 'required',
            'task' => 'required|url',
            'deadline' => 'required',
        ]);
        Assignment::create($validator->validated());
        return redirect()->route('teacher.assignments.index')->with('success', __('assignments.s_add_assignment'));
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
        $level_ids = auth('teacher')->user()->classes->pluck('level_id');
        $levels = Level::whereIn('id', $level_ids)->get();
        $assignment=Assignment::findOrFail($id);
        return view('Teacher.assignments.edit', compact('assignment','levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|',
            'subject_id' => 'required',
            'title' => 'required',
            'grade' => 'required',
            'task' => 'required|url',
            'deadline' => 'required',
        ]);
        $assignment=Assignment::findOrFail($id);
        $assignment->update($validator->validated());
        return redirect()->route('teacher.assignments.index')->with('success', __('assignments.s_update_assignment'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assignment=Assignment::findOrFail($id);
        $assignment->delete();
        return redirect()->back()->with('success', __('assignments.s_delete_assignment'));
    }
}
