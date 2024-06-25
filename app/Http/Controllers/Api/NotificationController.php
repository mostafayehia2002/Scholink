<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class NotificationController extends Controller
{
    use GeneralResponse;
    private  $status;

    public function getAllNotifications(Request $request)
    {
        try {
            $this->status = request('status');
            //validation
            $validate = validator::make(request()->all(), [
                'status' => 'required|in:parent,student',
            ]);
            //check errors
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $user = auth($this->status)->user();
            if (!$user) {
                return $this->errorMessage(401, trans('response.User_Not_Found'));
            }
            return $this->data(200, 'notifications', $user->notifications->take(5));
        }catch (\Exception $e){
            return  $this->errorMessage(500,$e->getMessage());
        }
    }

    public function getUnReadNotifications(Request $request)
    {
        try {
            $this->status = request('status');
            //validation
            $validate = validator::make(request()->all(), [
                'status' => 'required|in:parent,student',
            ]);
            //check errors
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $user = auth($this->status)->user();
            if (!$user) {
                return $this->errorMessage(401, trans('response.User_Not_Found'));
            }
            return $this->data(200, 'notifications', $user->unreadNotifications ->take(5));
        }catch (\Exception $e){
            return  $this->errorMessage(500,$e->getMessage());
        }
    }


    public function deleteAllNotifications(Request $request)
    {
        try {
            $this->status = $request->status;
            //validation
            $validate = validator::make(request()->all(), [
                'status' => 'required|in:parent,student',
            ]);
            //check errors
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $user = auth($this->status)->user();
            if (!$user) {
                return $this->errorMessage(401, trans('response.User_Not_Found'));
            }
           $user->notifications()->delete();
            return $this->successMessage(200,'successfully delete notifications');
        }catch (Exception $e){
            return  $this->errorMessage(500,$e->getMessage());
        }


    }

    public function deleteNotification(Request $request)
    {

    }

    public function readAllNotifications(Request $request)
    {
        try {
            $this->status = $request->status;
            //validation
            $validate = validator::make(request()->all(), [
                'status' => 'required|in:parent,student',
            ]);
            //check errors
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            $user = auth($this->status)->user();
            if (!$user) {
                return $this->errorMessage(401, trans('response.User_Not_Found'));
            }
            $user->notifications()->markAsRead();
            return $this->successMessage(200,'successfully read notifications');
        }catch (Exception $e){
            return  $this->errorMessage(500,$e->getMessage());
        }

    }

    public function readNotification(Request $request)
    {

    }

}
