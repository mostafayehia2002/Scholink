<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\ClassTeacher;
use App\Models\Level;
use App\Models\Material;
use App\Models\Subject;
use Illuminate\Http\Request;

class MaterialController extends Controller
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
        $data = Material::paginate(10);
        return view('Teacher.materials.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $level_ids = auth('teacher')->user()->classes->pluck('level_id');
        $levels = Level::whereIn('id', $level_ids)->get();
        return view('Teacher.materials.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'title' => 'required',
            'descriptions' => 'nullable',
            'type' => "required|in:lesson,video,exam",
            'material.*' => 'required|mimes:jpeg,png,jpg,gif,pdf'
        ]);
        $data = $request->except('material', 'level_id');
        $material = Material::create($data);
        foreach ($request->file('material') as $image) {
            $name = uniqid(10) . $image->getClientOriginalName();
            $image->storeAs('', $name, 'materials');
            $material->attachment()->create(['url' => "uploads/materials/$name"]);
        }
        return redirect()->route('teacher.materials.index')->with('success', __('materials.s_add_material'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material=Material::findOrFail($id);
        return view('Teacher.materials.show',compact('material'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getClass($level_id)
    {
        $classes = auth()->user()->classes->where('level_id', $level_id)->pluck('id', 'class_name');
        return json_encode($classes);
    }

    public function getSubject($id)
    {
        $subjects_id = ClassTeacher::where('teacher_id', auth('teacher')->user()->id)->where('class_id', $id)->pluck('subject_id');
        $data = Subject::whereIn('id', $subjects_id)->distinct()->pluck('id', 'name');
        return json_encode($data);
    }
}
