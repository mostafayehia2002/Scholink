<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ReactionController extends Controller
{
    use GeneralResponse;

    public function __construct(){

        $this->middleware('auth:parent');
     }
    public function reaction(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'post_id' =>'required|exists:contents,id',
            ]);
            if ($validate->fails()) {
                return $this->error(422,$validate->errors());
            }
            $user=Auth::guard('parent')->user();
            $content= Content::find($request->post_id);
             $react=$user->reactions->where('content_id',$content->id);
             if(empty($content)){
                 return $this->errorMessage(404,trans('response.Data_Not_Found'));
             }
             if(count($react)>0){
                 $user->reaction()->delete();
                 return $this->successMessage(200,trans('response.Successfully_Delete_Reaction'));
             }else{
                 $user->reaction()->create(['content_id'=>$content->id]);
                 return $this->successMessage(201,trans('response.Successfully_Create_Reaction'));
             }
        }catch (\Exception $e){
            return  $this->errorMessage(500,$e->getMessage()) ;
        }
    }

}
