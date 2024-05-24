<?php

use App\Broadcasting\PersonalNotification;
use App\Broadcasting\SendMessage;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('chat.{status}.{userId}',SendMessage::class,['guards' => ['admin', 'student', 'parent', 'teacher']]);
Broadcast::channel('notification.{status}.{userId}',SendMessage::class,['guards' => ['admin', 'student', 'parent', 'teacher']]);
