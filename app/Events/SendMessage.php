<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     *
     * create a new event instance
     *
     **/
    private  $conversation_id;
    private   $send_by_me;
     private  $sender;
     private  $receiver;
     private  $recever_status;
     private $message;
     private $send_at;
    public function __construct( $sender,$receiver,$receiver_status,$conversation_id,$message,$send_at)
    {
    $this->send_by_me=false;
    $this->sender=$sender->name;
    $this->receiver=$receiver->id;
    $this->recever_status=$receiver_status;
    $this->message=$message;
    $this->send_at=$send_at;
    $this->conversation_id=$conversation_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     *
     *
     **/
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("chat.$this->recever_status.$this->receiver"),
        ];
    }

    public function  broadcastWith(): array
    {
       return  [
          "send_by_me" =>$this->send_by_me,
           "sender"=> $this->sender,
          "message"=> $this->message,
          "send_at"=>  $this->send_at->diffForHumans(),
           "conversation_id"=>$this->conversation_id,
        ];

    }

}
