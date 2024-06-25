<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $user = auth()->user();
        return view('Admin.profile', compact('user'));
    }


    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => "required|string|max:255",
            'email' => "required|email|string|max:255|unique:admins,email," . $user->id,
            'password' => "nullable|string|min:5|confirmed",
        ]);
        $data = $request->only('email', 'name');
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        return redirect()->back()->with('success', __('profile.success_update'));
    }
}