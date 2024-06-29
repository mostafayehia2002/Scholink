<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }


    public function index()
    {
        $user = auth()->user();
        return view('Teacher.profile', compact('user'));
    }


    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name_ar' => "required|regex:/^[\p{Arabic} ]+$/u",
            'name_en' => ["required", "regex:/^[a-zA-Z ]+$/"],
            'email' => "required|email|string|max:255|unique:teachers,email," . $user->id,
            'phone' => "required|string|max:255|unique:teachers,phone," . $user->id,
            'address' => "required|string",
            'password' => "nullable|string|min:5|confirmed",
        ]);
        $data = $request->only('email', 'phone', 'address');
        $data['name'] = ['ar' => $request->name_ar, 'en' => $request->name_en];
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        return redirect()->back()->with('success', __('profile.success_update'));
    }
}