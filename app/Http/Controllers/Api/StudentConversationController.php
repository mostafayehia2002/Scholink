<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ParticipantResource;
use App\Models\Conversation;
use App\Models\Level;
use App\Models\Message;
use App\Models\ParentStudent;
use App\Models\Student;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentConversationController extends Controller
{
    use GeneralResponse;
    //
    public function  getParticipants()
    {
        try{
             $student = Auth::guard('student')->user();
             return $this->data(200,'participants',ParticipantResource::collection($student->classe->teachers));

        }catch (\Exception $e){

            return $this->errorMessage(500, $e->getMessage());
        }
    }


    public function  getConversations()
    {
        try{
            //get list of teacher conversations
            $conversations = auth('student')->user()->conversations()
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
           if ($validate->fails()) {
               return $this->error( 422,$validate->errors());
           }
           $user=Auth::guard('student')->user();
           $messages=Message::where('conversation_id', $request->conversation_id)
               ->where('sender_id', $user->id)
               ->where('sender_type', get_class($user))
               ->get();
           if ($messages->isEmpty()){
               return $this->errorMessage(404,trans('response.Data_Not_Found'));
           }
           return  $this->data(200,'messages',MessageResource::collection($messages)->additional(['guard'=>'student']));

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
            $user = Student::find(auth('student')->id());
                // If conversation ID is not provided or doesn't match, check if there's an existing conversation
                $conversation = Conversation::where('teacher_id', $request->teacher_id)
                    ->where('participant_id', $user->id)
                    ->where('participant_type', get_class($user))
                    ->first();
                if (!$conversation) {
                    // If no existing conversation is found, create a new one
                    $conversation = $user->conversations()->create([
                        'teacher_id' => $request->teacher_id,
                    ]);
                }

            // Add the message to the (existing or new) conversation
            $user->messages()->create([
                'conversation_id' => $conversation->id,
                'content' => $request->message,
            ]);

            return $this->successMessage(201, 'Message sent successfully');
        } catch (\Exception $e) {
            return $this->errorMessage(500, $e->getMessage());
        }
    }


}
