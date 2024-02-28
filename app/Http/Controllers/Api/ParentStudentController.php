<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParentResource;
use App\Models\Register;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ParentStudentController extends Controller
{
    use GeneralResponse;
    public function __construct()
    {
        $this->middleware('auth:parent');
    }
    public function profile()
    {
        try {
            return $this->data(200, 'data',ParentResource::make( auth()->guard('parent')->user()));
        } catch (\Exception $e) {
            return  $this->error( 500,$e->getMessage());
        }
    }


    public function logout()
    {
        try {
            auth()->guard('parent')->logout();
            return $this->successMessage(200, trans('response.Successfully_Logged_Out'));
        } catch (\Exception $e) {
            return  $this->error( 500,$e->getMessage());
        }
    }

    public function refresh()
    {
        try {
            return $this->respondWithToken(auth()->guard('parent')->refresh());
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
                'expires_in' => auth()->guard('parent')->factory()->getTTL() *60*24*30,
            ]);
        } catch (\Exception $e) {

            return  $this->error( 500,$e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = auth('parent')->user();
            $oldImg =$user->photo;
            if($request->hasFile('photo')){
                $img =time().$request->file('photo')->getClientOriginalName();
                $request->file('photo')->storeAs('/', $img, 'parent');
                if ($oldImg !== asset('uploads/parents/profile/profile.jpg')) {
                    Storage::disk('parent')->delete('/' . $oldImg);
                }
            }else{
                $img = $oldImg;
            }
            $validate = Validator::make(request()->all(), [
                'name_en' =>"required|regex:/^[a-zA-Z ]+/",
                'name_ar'=> "required|regex:/^[\p{Arabic} ]+/u",
                'email' => "required|email|unique:parents,email," . $user->id,
                'mobile' => "required|string|unique:parents,mobile," . $user->id,
                'national_id' => "required|min:14,max:14",
                'address' => "required",
                'job' => "required",
                'date_birth' => "required|date",
            ]);
            if ($validate->fails()) {
                return $this->error( 422,$validate->errors());
            }
            $data = $validate->validate();
            $data['photo']='uploads/parents/profile/'.$img;
            $data['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
            $user->update($data);
            return $this->successMessage(200, trans('response.Successfully_Update_Profile'));
        } catch (\Exception $e) {
            return  $this->error( 500,$e->getMessage());
        }
    }

    public function changePassword(Request $request){
        try {
            $user = auth('parent')->user();
            $validate = Validator::make(request()->all(), [
                'password' => "required|confirmed|min:6",
            ]);
            if ($validate->fails()) {
                return $this->error( 422,$validate->errors());
            }
             $user->update(['password' => Hash::make($request->password)]);
                // تحديث ناجح
                return $this->successMessage(200, trans('response.Successfully_Change_Password'));

       }catch (\Exception $e){
            return  $this->error(500,$e->getMessage());
        }
    }
}
