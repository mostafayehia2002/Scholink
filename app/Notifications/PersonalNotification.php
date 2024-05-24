<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Broadcasting\Channel;
class PersonalNotification extends Notification
{
    use Queueable;

    protected  $notification_type;
     protected $receiver_status;
     protected $sender;
     protected  $recever;

    protected $notification_message;
    public function __construct($sender,$receiver,$receiver_status,$notification_type)
    {
        $this->sender=$sender->name;
        $this->recever=$receiver->id;
        $this->receiver_status=$receiver_status;
        $this->notification_type=$notification_type;
        $this->notification_message="$this->sender send $notification_type to $receiver->name";
    }
    public function via($notifiable): array
    {
        return ['database','broadcast'];
    }

    public function toDatabase($notifiable): array
    {
        return [
           'notification_type' =>$this->notification_type,
            'message'=>$this->notification_message,
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'notification_type' =>$this->notification_type,
             'message'=>$this->notification_message,
        ]);
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("notification.$this->receiver_status.$this->recever"),
        ];
    }
}
