<?php

namespace App\Http\Resources;

use App\Models\ParentStudent;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
   private $Comments=[],$Reactions=[];
    public function toArray(Request $request): array
    {
        $i=0;
        foreach ($this->comments as $comment){
             $id=$comment->commentable_id;
             $model=$comment->commentable_type;
             $content=$comment->comment;
             $user=$comment->commentable;
            $this->Comments[$i++]=['username'=>$user->name,'email'=>$user->email,'comment'=>$content,'created_at'=>$comment->created_at];
        }

        $x=0;
        foreach ($this->reactions as $reaction){
            $id=$reaction->reactable_id;
            $model=$reaction->reactable_type;
            $user=$reaction->reactable;
            $this->Reactions[$x++]=['username'=>$user->name,'email'=>$user->email,'created_at'=>$comment->created_at];
        }


        return [
            'content'=>$this->content,
            'total_comments'=>count($this->Comments),
            'total_reactions'=>count($this->Reactions),
            'created_at'=>date_format($this->created_at,'d-M-Y h:i A'),
             'comments'=>$this->Comments,
            'reactions'=>$this->Reactions,
            'photos'=>$this->photos,
        ];
    }
}
