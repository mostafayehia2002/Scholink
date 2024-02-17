<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VisionController extends Controller
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
        $category_id = Category::where('name', 'visions')->first()->id;
        $data = Content::latest()->with(['comments', 'reactions', 'photos'])->where('category_id', $category_id)->paginate(20);
        return view('Admin.media.visions', compact('data'));
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
                'content' => 'required|string',
                'images.*' => 'required|mimes:jpeg,png,jpg,gif'
            ]);

            $category_id = Category::where('name', 'visions')->first()->id;
            $post = Content::create([
                'category_id' => $category_id,
                'content' => $request->content,
                'admin_id'=>auth()->user()->id,
            ]);
            foreach ($request->file('images') as $image) {
                $name = uniqid(10) . $image->getClientOriginalName();
                $image->storeAs('', $name, 'medias');
                $post->photo()->create(['name' => "uploads/medias/$name"]);
            }

            return redirect()->back()->with('success', 'Success Add Visions');
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
        try {
            $request->validate([
                'content' => 'required|string',
                'images.*' => 'nullable|mimes:jpeg,png,jpg,gif'
            ]);

            $post = Content::findOrFail($id);

            if ($request->file('images')!=null) {
                //Delete Old Image
                foreach ($post->photos as $image) {
                    File::delete(ltrim(parse_url($image->name)['path'], '/'));
                    $image->delete();
                }
                //Add New Image
                foreach ($request->file('images') as $image) {
                    $name = uniqid(10) . $image->getClientOriginalName();
                    $image->storeAs('', $name, 'medias');
                    $post->photo()->create(['name' => "uploads/medias/$name"]);
                }

            }
            $post->update(['content'=>$request->content]);
            return redirect()->back()->with('success', 'Success Update Post');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Content::findOrFail($id);
            foreach ($post->photos as $image) {
                File::delete(ltrim(parse_url($image->name)['path'], '/'));
                $image->delete();
            }
            $post->delete();

            return redirect()->back()->with('success', 'Success Delete Vision');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
