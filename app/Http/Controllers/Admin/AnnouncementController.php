<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnnouncementController extends Controller
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
        $announcement = Category::where('name', 'announcements')->first();
        $data = SubCategory::with('announcements')->where('category_id', $announcement->id)->get();
        $categories = $announcement->subcategories;
//        return  $data;
        return view('Admin.media.announcements', compact('data', 'categories'));

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
                'price' => 'required|numeric',
                'photo' => 'required|mimes:jpeg,png,jpg,gif'
            ]);

            $category_id = SubCategory::findOrFail($request->subcategory_id)->category->id;
            $name = uniqid(10) . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('', $name, 'medias');
            Announcement::create([
                'category_id' => $category_id,
                'subcategory_id' => $request->subcategory_id,
                'price' => $request->price,
                'photo' => "uploads/medias/$name",
                'admin_id' => auth()->user()->id,
            ]);

            return redirect()->back()->with('success', 'Success Add Announcement');
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
                'price' => 'required|numeric',
                'photo' => 'nullable|mimes:jpeg,png,jpg,gif'
            ]);
            $announcement = Announcement::findOrFail($id);
            $category_id = SubCategory::findOrFail($request->subcategory_id)->category->id;
            $data=$request->except('photo');
            $data['category_id'] = $category_id;

            if ($request->file('photo') != null) {
                //Delete Old Image
                File::delete(ltrim(parse_url($announcement->name)['path'], '/'));
                //Add New Image
                $name = uniqid(10) . $request->file('photo')->getClientOriginalName();
                $request->file('photo')->storeAs('', $name, 'medias');
                $data['photo']= "uploads/medias/$name";
            }
            $announcement->update($data);
            return redirect()->back()->with('success', 'Success Update Announcement');
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
            $announcement = Announcement::findOrFail($id);
            File::delete(ltrim(parse_url($announcement->name)['path'], '/'));
            $announcement->delete();
            return redirect()->back()->with('success', 'Success Delete Announcement');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
