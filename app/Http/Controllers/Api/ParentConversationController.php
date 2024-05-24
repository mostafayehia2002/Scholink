<?php

namespace App\Http\Controllers\Api;

use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ParticipantResource;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\ParentStudent;
use App\Models\Student;
use App\Models\Teacher;
use App\Notifications\GeneralNotification;
use App\Notifications\PersonalNotification;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ParentConversationController extends Controller
{
    use GeneralResponse;
    //
    public function  getParticipants(Request $request)
    {
        try{
            $validate=Validator::make(
                $request->all(),
                [
                    'student_id' => "required|exists:students,id",
                ]
            );
            if ($validate->fails()) {
                return $this->error( 422,$validate->errors());
            }
             $student = Student::find($request->student_id);

             return $this->data(200,'participants',ParticipantResource::collection($student->classe->teachers));

        }catch (\Exception $e){

            return $this->errorMessage(500, $e->getMessage());
        }
    }


    public function  getConversations()
    {
        try{
            //get list of teacher conversations
            $conversations = auth('parent')->user()->conversations()
            ->join('teachers', 'conversations.teacher_id', '=', 'teachers.id')->get();
            if ($conversations->count()==0){
                return $this->errorMessage(404,trans('response.Data_Not_Found'));
            }
            return $this->data(200,'conversations', ConversationResource::collection($conversations));

        }catch (\Exception $e){

            return $this->errorMessage(500, $e->getMessage());}
    }

   public function getMessages(Request $request)
   {
       try{
           $validate=Validator::make(
               $request->all(),
               [
                   'conversation_id' => "required|exists:conversations,id",
               ]
           );
           $user=Auth::guard('parent')->user();
           if ($validate->fails()) {
               return $this->error( 422,$validate->errors());
           }
           $messages=Message::where('conversation_id', $request->conversation_id)
               ->where('sender_id', $user->id)
               ->where('sender_type', get_class($user))
               ->get();
           if ($messages->isEmpty()){
               return $this->errorMessage(404,trans('response.Data_Not_Found'));
           }
           return  $this->data(200,'messages',MessageResource::collection($messages)->additional(['guard'=>'parent']));

       }catch (\Exception $e){

           return $this->errorMessage(500, $e->getMessage());
       }

   }

    public function sendMessage(Request $request)
    {
        try {
            // Validate the request data
            $validate = Validator::make(
                $request->all(),
                [
                    'teacher_id' => 'required|exists:teachers,id',
                    'message' => 'required|string',
                ]
            );
            if ($validate->fails()) {
                return $this->error(422, $validate->errors());
            }
            // Get the authenticated user
            $parent = ParentStudent::find(auth('parent')->id());
                // If conversation ID is not provided or doesn't match, check if there's an existing conversation
                $conversation = Conversation::where('teacher_id', $request->teacher_id)
                    ->where('participant_id', $parent->id)
                    ->where('participant_type', get_class($parent))
                    ->first();
                if (!$conversation) {
                    // If no existing conversation is found, create a new one
                    $conversation = $parent->conversations()->create([
                        'teacher_id' => $request->teacher_id,
                    ]);
                }
            // Add the message to the (existing or new) conversation
            $parent->messages()->create([
                'conversation_id' => $conversation->id,
                'content' => $request->message,
            ]);

            $teacher=Teacher::find($request->teacher_id);
            //push message to teacher through his private channel
            broadcast(new SendMessage($parent,$teacher,'teacher',$conversation->id,$request->message,now() ));
            //send notification to teacher in PersonalNotification channel and save it in database
            $teacher->notify(new PersonalNotification($parent,$teacher,'teacher','message'));


            return $this->successMessage(201, 'Message sent successfully');
        } catch (\Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }
    }


}
