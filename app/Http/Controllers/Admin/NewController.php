<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Content;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $categories = Category::whereJsonContains('name->en', 'news')->first()->subcategories;
        $data = News::latest()->paginate(15);
        return view('Admin.media.news', compact('data', 'categories'));
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
                'subcategory_id' => 'required|exists:sub_categories,id',
                'news_content' => 'required|string',
                'title'=>"required|string|max:255",
                'images.*' => 'required|mimes:jpeg,png,jpg,gif'
            ]);
            $category_id =Category::whereJsonContains('name->en', 'news')->first()->id;
            $new = News::create([
                'category_id' => $category_id,
                'subcategory_id' => $request->subcategory_id,
                'content' => $request->news_content,
                'title'=>$request->title,
                'admin_id'=>auth()->user()->id,
            ]);

            foreach ($request->file('images') as $image) {
                $name = uniqid(10) . $image->getClientOriginalName();
                $image->storeAs('', $name, 'medias');
                $new->photo()->create(['name' => "uploads/medias/$name"]);
            }

            return redirect()->back()->with('success', 'Success Add News');
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
                'subcategory_id' => 'required|exists:sub_categories,id',
                'news_content' => 'required|string',
                'title'=>"required|string|max:255",
                'images.*' => 'nullable|mimes:jpeg,png,jpg,gif'
            ]);

            $news = News::findOrFail($id);

            if ($request->file('images')!=null) {
                //Delete Old Image
                foreach ($news->photos as $image) {
                    File::delete(ltrim(parse_url($image->name)['path'], '/'));
                    $image->delete();
                }
                //Add New Image
                foreach ($request->file('images') as $image) {
                    $name = uniqid(10) . $image->getClientOriginalName();
                    $image->storeAs('', $name, 'medias');
                    $news->photo()->create(['name' => "uploads/medias/$name"]);
                }

            }
            $news->update(
                [
                    'subcategory_id' => $request->subcategory_id,
                    'content' => $request->news_content,
                    'title'=>$request->title,
                ]
            );
            return redirect()->back()->with('success', 'Success Update News');
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
            $news = News::findOrFail($id);
            foreach ($news->photos as $image) {
                File::delete(ltrim(parse_url($image->name)['path'], '/'));
                $image->delete();
            }
            $news->delete();
            return redirect()->back()->with('success', 'Success Delete News');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
