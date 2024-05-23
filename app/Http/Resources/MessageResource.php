<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'send_by_me'=>$this->sender->name==auth($request->guard)->user()->name?true:false,
            'sender'=> $this->sender->name==auth($request->guard)->user()->name?trans('response.Me'):$this->sender->name,
            'message'=>$this->content,
            'send_at'=>$this->created_at,
        ];
    }
}
