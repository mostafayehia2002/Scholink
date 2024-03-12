<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ValidationCode;
use App\Models\Register;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\Translation\t;

class RegisterController extends Controller
{
    use GeneralResponse;
    public function register(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'parent_name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                    "parent_name_en" => "required|regex:/^[a-zA-Z ]+/",
                    'parent_email' => "required|email",
                    'parent_mobile' => "required|string|max:11",
                    'parent_data_birth'=>'required|date',
                    'parent_national_id' => 'required|numeric|min:14,max:14',
                    'parent_address' => 'required|string',
                    'parent_job' => 'required',
                    'parent_gender' => 'required|in:male,female',
                    'child_name_en' =>"required|regex:/^[a-zA-Z ]+/",
                    'child_name_ar' => "required|regex:/^[\p{Arabic} ]+/u",
                    'child_date_birth' => 'required|date',
                    'child_birth_certificate'=>'required|image|mimes:jpeg,png,jpg',
                    'child_gender' => 'required|in:male,female',
                    'child_level' => 'required|in:1,2,3,4,5,6',
                    'child_school_name' => 'string',
                ]
            );
            if ($validate->fails()) {
                return $this->error(422,$validate->errors());
            }

            $data=$validate->validate();
            //store images
            $img1 =time().$request->file('parent_personal_identification')->getClientOriginalName();
            $request->file('parent_personal_identification')->storeAs('/register', $img1, 'parent');
            $data['parent_personal_identification']= 'uploads/parents/register/'.$img1;
            $img2 =time().$request->file('child_birth_certificate')->getClientOriginalName();
            $request->file('child_birth_certificate')->storeAs('/register', $img2, 'parent');
            $data['child_birth_certificate']= 'uploads/parents/register/'.$img2;

           //store name in en and ar
           $data['parent_name']=['en'=>$request->parent_name_en,'ar'=>$request->parent_name_ar];
          $data['child_name']=['en'=>$request->child_name_en,'ar'=>$request->child_name_ar];
          $message_otp = rand(1111, 9999);
            $data['message_otp']=$message_otp;
           $register =Register::create($data);
          Mail::to($register->parent_email)->send(new ValidationCode($register->parent_email, $message_otp, 'Register Confirmation'));
         return $this->successMessage(200, trans('response.Successfully_Send_Code'));
        }catch (\Exception $e){
            return  $this->error( 500,$e->getMessage());
        }
    }


    public  function registerConfirmed(Request $request){

        try{
            $validate = Validator::make(
                $request->all(),
                [
                    'email' => "required|email",
                    'message_otp'=>'required|max:4',
                ]
            );
            if ($validate->fails()) {
                return $this->error( 422,$validate->errors());
            }
            $routeName = $request->route()->getName();
            $key = 'route_visits_' . $routeName;
           $register=Register::where('parent_email',$request->email)->where('message_otp',$request->message_otp)->first();
           if(!$register){
               $visits = Cache::increment($key);
               if($visits >=3) {
                   return $this->error(422,trans('response.Failed_Confirm_Data'));
               }
              return $this->error(   401,trans('response.User_Not_Found').' '. trans('response.Or').' '.trans('response.Otp_Is_Failed'));
           }else{
               $register->update(['status'=>'confirmed']);
            return  $this->successMessage(200,trans('response.Successfully_Send_Data'));

           }
        }catch (\Exception $e){
            return  $this->error( 500,$e->getMessage());
        }
    }




}
