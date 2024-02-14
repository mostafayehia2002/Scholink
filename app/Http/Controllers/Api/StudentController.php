<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Register;
use App\Traits\GeneralResponse;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class StudentController extends Controller
{
    use GeneralResponse;
    public function __construct()
    {
        $this->middleware('auth:student');
    }
    public function profile()
    {
        try {
            return $this->data(200, 'data', auth()->guard('student')->user());
        } catch (\Exception $e) {
            return  $this->error(500,$e->getMessage());
        }
    }
    public function logout()
    {
        try {
            auth()->guard('student')->logout();
            return $this->successMessage(200, trans('response.Successfully_Logged_Out'));
        } catch (\Exception $e) {

            return  $this->error( 500,$e->getMessage());
        }
    }
    public function refresh()
    {
        try {
            return $this->respondWithToken(auth()->guard('student')->refresh());
        } catch (\Exception $e) {
            return  $this->error( 500,$e->getMessage());
        }
    }
    protected function respondWithToken($token)
    {
        try {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->guard('student')->factory()->getTTL() * 60
            ]);
        } catch (\Exception $e) {
            return  $this->error( 500,$e->getMessage());
        }
    }
    public function changePassword(Register $request){
        try {
            $user = auth('student')->user();
            $validate = Validator::make(request()->all(), [
                'password' => "required|confirmed|min:6",
            ]);
            if ($validate->fails()) {
                return $this->error( 422,$validate->errors());
            }
            $user->update(['password'=>bcrypt($request->password)]);
            return $this->successMessage(200, trans('response.Successfully_Change_Password'));
        }catch (\Exception $e){
            return  $this->error( 500,$e->getMessage());
        }
    }
}
