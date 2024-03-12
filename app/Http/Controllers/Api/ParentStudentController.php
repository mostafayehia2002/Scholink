<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChildrenResource;
use App\Http\Resources\ParentResource;
use App\Mail\ValidationCode;
use App\Models\Level;
use App\Models\Register;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            return $this->data(200, 'data', ParentResource::make(auth()->guard('parent')->user()));
        } catch (\Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }
    }


    public function logout()
    {
        try {
            auth()->guard('parent')->logout();
            return $this->successMessage(200, trans('response.Successfully_Logged_Out'));
        } catch (\Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }
    }

    public function refresh()
    {
        try {
            return $this->respondWithToken(auth()->guard('parent')->refresh());
        } catch (\Exception $e) {

            return $this->errorMessage(500, $e->getMessage());
        }
    }


    protected function respondWithToken($token)
    {
        try {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->guard('parent')->factory()->getTTL() * 60 * 24 * 30,
            ]);
        } catch (\Exception $e) {

            return $this->errorMessage(500, $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = auth('parent')->user();
            $oldImg = $user->photo;
            if ($request->hasFile('photo')) {
                $img = time() . $request->file('photo')->getClientOriginalName();
                $request->file('photo')->storeAs('/', $img, 'parent');
                if ($oldImg !== asset('uploads/parents/profile/profile.jpg')) {
                    Storage::disk('parent')->delete('/' . $oldImg);
                }
            } else {
                $img = $oldImg;
            }
            $validate = Validator::make(request()->all(), [
                'name_en' => "required|regex:/^[a-zA-Z ]+/",
                'name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                'email' => "required|email|unique:parents,email," . $user->id,
                'mobile' => "required|string|unique:parents,mobile," . $user->id,
                'national_id' => "required|min:14,max:14",
                'address' => "required",
                'job' => "required",
                'date_birth' => "required|date",
            ]);
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $data = $validate->validate();
            $data['photo'] = 'uploads/parents/profile/' . $img;
            $data['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $user->update($data);
            return $this->successMessage(200, trans('response.Successfully_Update_Profile'));
        } catch (\Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $user = auth('parent')->user();
            $validate = Validator::make(request()->all(), [
                'password' => "required|confirmed|min:6",
            ]);
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $user->update(['password' => Hash::make($request->password)]);
            // تحديث ناجح
            return $this->successMessage(200, trans('response.Successfully_Change_Password'));

        } catch (\Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }
    }


    //get all child of parent
    public function getChildren()
    {
        try {
            $parent = auth('parent')->user();
            $children = $parent->students()
                ->join('classes', 'students.class_id', '=', 'classes.id')
                ->join('levels', 'classes.level_id', '=', 'levels.id')
                ->select('students.*', 'classes.class_name', 'levels.level_name')
                ->get();
            return $this->data(200, 'Children', ChildrenResource::collection($children));

        } catch (\Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }
    }


    public function addNewChild(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [

                    'child_name_en' => "required|regex:/^[a-zA-Z ]+/",
                    'child_name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                    'child_date_birth' => 'required|date',
                    'child_birth_certificate' => 'required|image|mimes:jpeg,png,jpg',
                    'child_gender' => 'required|in:male,female',
                    'child_level' => 'required|in:1,2,3,4,5,6',
                    'child_school_name' => 'string',
                ]
            );
            $user = auth('parent')->user();
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $img = time() . $request->file('child_birth_certificate')->getClientOriginalName();
            $request->file('child_birth_certificate')->storeAs('/register', $img, 'parent');
            $photo = 'uploads/parents/register/' . $img;
            //store name in en and ar
            $message_otp = rand(1111, 9999);
            $register=Register::create([
                'parent_name' => ['ar' => $user->getTranslation('name', 'ar'), 'en' => $user->getTranslation('name', 'en'),],
                'parent_email' => $user->email,
                'parent_mobile' => $user->mobile,
                'parent_data_birth' => $user->date_birth,
                'parent_national_id' => $user->national_id,
                'parent_address' => $user->address,
                'parent_job' => $user->job,
                'parent_gender' => $user->gender,
                'parent_personal_identification' => $user->personal_identification,
                'child_name' => ['en' => $request->child_name_en, 'ar' => $request->child_name_ar],
                'child_date_birth' => $request->child_date_birth,
                'child_birth_certificate' => $photo,
                'child_gender' => $request->child_gender,
                'child_level' => $request->child_level,
                'child_school_name' => $request->child_school_name,
                'message_otp' => $message_otp,
                'status' => 'confirmed',
            ]);
            return $this->successMessage(200, trans('response.Successfully_Send_Data'));
        } catch (\Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }


    }

}
