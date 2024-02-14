<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Mail\ValidationCode;
use App\Models\ParentStudent;
use App\Models\Register;
use App\Models\Student;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    private  $status;
    use GeneralResponse;
    public function login()
    {
        $credentials = request(['email', 'password']);
        $this->status = request('status');
        //validation
        $validate = validator::make(request()->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
            'status' => 'required|in:parent,student',
        ]);
        //check errors
        if ($validate->fails()) {
            return $this->error(422,$validate->errors());
        }
        if (!$token = auth()->guard($this->status)->attempt($credentials)) {
            return $this->error(  401,trans('response.User_Not_Found'));
        }

        return  $this->data(200, 'token', $token);
    }


    public function resetPassword(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => "required|email",
                'status' => "required|in:parent,student"
            ]);
            if ($validate->fails()) {
                return $this->error(422,$validate->errors());
            }
            $user = '';
            if (request('status') == 'student') {
                $user = Student::where('email', '=', $request->email)->first();
                if (!$user) {
                    return $this->error( 401,trans('response.User_Not_Found'));
                }
            } else {
                $user = ParentStudent::where('email', '=', $request->email)->first();
                if (!$user) {
                    return $this->error(401,trans('response.User_Not_Found'));
                }
            }
            $message_otp = rand(1111, 9999);
            $user->update(['message_otp' => $message_otp]);
            Mail::to($user)->send(new ValidationCode($user->name, $message_otp,'Reset Password'));
            return $this->successMessage(200, trans('response.Successfully_Send_Code'));
        } catch (\Exception $e) {
            return  $this->error(500,$e->getMessage());
        }
    }

    public function confirmOtp(Request $request)
    {
        try{
        $validate = Validator::make($request->all(), [
            'email' => "required|email",
            'status' => "required|in:parent,student",
            'message_otp' => "required|min:4,max:4",
        ]);
        if ($validate->fails()) {
            return $this->error(422,$validate->errors());
        }
        $user = '';
        if (request('status') == 'student') {
            $user = Student::where('email', '=', $request->email)->where('message_otp', $request->message_otp)->first();
            if (!$user) {
                return $this->error(422,trans("response.Otp_Is_Failed"));
            }
        } else {
            $user = ParentStudent::where('email', '=', $request->email)->where('message_otp', $request->message_otp)->first();
            if (!$user) {
                return $this->error(422,trans("response.Otp_Is_Failed"));
            }
        }
        return $this->successMessage(200, trans('response.Successfully_Confirm_Code'));
    } catch (\Exception $e) {
      return  $this->error(500,$e->getMessage());
}
    }
    public function newPassword(Request $request)
    {
        try{
        $validate = Validator::make($request->all(), [
            'email' => "required|email",
            'status' => "required|in:parent,student",
            'password' => 'required|confirmed|string|min:6',
        ]);
        if ($validate->fails()) {
            return $this->error( 422,$validate->errors());
        }
        $user = '';
        if (request('status') == 'student') {
            $user = Student::where('email', '=', $request->email)->first();
            if (!$user) {
                return $this->error(401,trans('response.User_Not_Found'));
            }
        } else {
            $user = ParentStudent::where('email', '=', $request->email)->first();
            if (!$user){
                return $this->error(401,trans('response.User_Not_Found'));
            }
        }
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return $this->successMessage(200, trans('response.Successfully_Change_Password'));
    } catch (\Exception $e) {
       return  $this->error(500,$e->getMessage());
    }
    }
}
