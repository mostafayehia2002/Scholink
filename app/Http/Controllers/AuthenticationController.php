<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest');
    }

    public function  index(){
        return view('login');
    }

    public function login(Request $request){
//       return  $request->all();
        $request->validate(['email'=>'required|email','password'=>'required|string','type'=>'required']);
        $remember=$request->remember?true:false;
        if($request->type=='admin'){
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$remember)) {
                return redirect()->route('admin.dashboard')->with('success',__('login.success'));
            }
        }else{
            if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password],$remember)) {
                return redirect()->route('teacher.dashboard')->with('success',__('login.success'));
            }
        }
        return redirect()->back()->withInput($request->only('email'))->with('error',__('login.error'));
    }


    public function logout(Request $request){
        Auth::guard($request->auth)->logout();
        return redirect()->route('login_form')->with('success',__('login.logout'));
    }
}
