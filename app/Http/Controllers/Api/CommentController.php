<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Content;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    use GeneralResponse;
    public function __construct(){

        $this->middleware('auth:parent');
    }
    public function comment(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'post_id' => 'required|exists:contents,id',
                'comment' => 'required',
            ]);
            if ($validate->fails()) {
                return $this->error(422,$validate->errors());
            }
            $user=Auth::guard('parent')->user();

            $content= Content::find($request->post_id);
            if(empty($content)) {
                return $this->errorMessage( 404,trans('response.Data_Not_Found'));
            }
            $user->comment()->create(['content_id' => $content->id, 'comment' => $request->comment]);
            return $this->successMessage(201, trans('response.Successfully_Create_Comment'));
        }catch (\Exception $e){
         return  $this->errorMessage(500,$e->getMessage()) ;
        }
    }
    public function deleteComment(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'id' => 'required',

            ]);
            if ($validate->fails()) {
                return $this->error(422,$validate->errors());
            }
            $comment=Comment::find($request->id);
            if(empty($comment)){
                return $this->errorMessage(404,trans('response.Data_Not_Found'));
            }
            $comment->delete();
            return $this->successMessage(200,trans('response.Successfully_Delete_Comment'));
        }catch (\Exception $e){
            return  $this->errorMessage(500,$e->getMessage()) ;
        }

    }


    public function updateComment(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'id' => 'required',
                'comment'=>'required'
            ]);
            if ($validate->fails()) {
                return $this->error(422,$validate->errors());
            }
            $comment=Comment::find($request->id);
            if(empty($comment)){
                return $this->error(404,trans('response.Data_Not_Found'));
            }
            $comment->update(['comment'=>$request->comment]);
            return $this->successMessage(200,trans('response.Successfully_Update_Comment'));
          }catch (\Exception $e){
            return  $this->error(500,$e->getMessage()) ;
        }

    }
}
