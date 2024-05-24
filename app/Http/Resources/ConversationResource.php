<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

            return [
                'conversation_id'=>$this->id,
                'teacher_id'=>$this->teacher_id,
                'name'=>$this->name,
            ];

    }
}
