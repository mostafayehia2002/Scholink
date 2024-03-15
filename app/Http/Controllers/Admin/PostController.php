<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $category_id = Category::whereJsonContains('name->en', 'posts')->first()->id;
        $data = Content::latest()->with(['comments', 'reactions', 'photos'])->where('category_id', $category_id)->paginate(20);
        return view('Admin.media.posts', compact('data'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'post_content' => 'required|string',
                'images.*' => 'mimes:jpeg,png,jpg,gif'
            ]);
            $category = Category::whereJsonContains('name->en', 'posts')->first();
           $post=$category->contents()->create([
                'content' => $request->post_content,
                'admin_id'=>auth()->user()->id,
            ]);
            if($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $name = uniqid(10) . $image->getClientOriginalName();
                    $image->storeAs('', $name, 'medias');
                    $post->photo()->create(['name' => "uploads/medias/$name"]);
                }
            }
            return redirect()->back()->with('success', 'Success Add Post');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'post_content' => 'required|string',
                'images.*' => 'nullable|mimes:jpeg,png,jpg,gif'
            ]);
            $post = Content::findOrFail($id);
            if ($request->file('images') != null) {
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
            $post->update(['content' => $request->post_content]);
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
            return redirect()->back()->with('success', 'Success Delete Post');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
