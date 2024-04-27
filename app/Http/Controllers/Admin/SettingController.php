<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $setting=Setting::first();
        return view('Admin.setting',compact('setting'));
    }
    public function update(Request $request)
    {

        try {
            $request->validate([
                'name'=>"required|string",
                'number_seats'=>"required|integer",
                'description'=>"nullable|string",
                'logo' => "nullable|image|mimes:jpeg,png,jpg,gif",
            ]);
            $setting=Setting::first();
            $data=$request->except('logo');
            //Store
            if ($request->hasFile('logo')&&$request->logo!=null) {
                //Delete Old Logo
                File::delete(ltrim(parse_url($setting->logo)['path'], '/'));
                $name = uniqid(5) . $request->file('logo')->getClientOriginalName();
                $request->file('logo')->storeAs('', $name, 'logo');
                $data['logo'] = "uploads/logo/" . $name;
            }
            $setting->update($data);
            return redirect()->back()->with('success','Success Update Data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




}
