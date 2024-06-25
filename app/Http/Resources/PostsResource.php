<?php

namespace App\Http\Resources;

use App\Models\ParentStudent;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    public function toArray($request)
    {
        // Load comments and reactions eagerly
        $this->load('comments.commentable', 'reactions.reactable');

        return [
            'id' => $this->id,
            'content' => $this->content,
            'total_comments' => $this->comments->count(),
            'total_reactions' => $this->reactions->count(),
            'created_at' => $this->created_at,
            'comments' => $this->comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'username' => $comment->commentable->name,
                    'email' => $comment->commentable->email,
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at,
                ];
            }),
            'reactions' => $this->reactions->map(function ($reaction) {
                return [
                    'username' => $reaction->reactable->name,
                    'email' => $reaction->reactable->email,
                    'created_at' => $reaction->created_at,
                ];
            }),
            'photos' => $this->photos,
        ];
    }
}
