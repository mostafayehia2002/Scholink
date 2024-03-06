<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Level;
use Illuminate\Http\Request;

class ClassController extends Controller
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
        $data = Classe::paginate(10);
        $levels = Level::all();
        return view('Admin.classes', compact('data', 'levels'));
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

            $request->validate([
                "level_id" => "required|exists:levels,id",
                'class_name' => "required|numeric"
            ]);
            Classe::create([
                'level_id' => $request->level_id,
                'class_name' => $request->class_name,
            ]);
            return redirect()->back()->with('success', 'Success Addedd Class');
        } catch (\Exception $e) {
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
            $classe=Classe::findOrFail($id);
            $request->validate([
                "level_id" => "required|exists:levels,id",
                'class_name' => "required|numeric"
            ]);
            $classe->update([
                'level_id' => $request->level_id,
                'class_name' => $request->class_name,
            ]);
            return redirect()->back()->with('success', 'Success Updated Class');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Classe::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Success Deleted Class');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}
