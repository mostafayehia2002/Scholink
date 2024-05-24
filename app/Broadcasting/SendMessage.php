<?php

namespace App\Broadcasting;
use App\Models\Admin;
use App\Models\ParentStudent;
use App\Models\Student;
use App\Models\Teacher;

class SendMessage
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join($user,$status, $userId)
    {
        // Check if the authenticated user is a teacher and if $user is an instance of Teacher
        if (auth()->guard('teacher')->check() && $user instanceof Teacher) {
            return $user->id==$userId;
        }
        // Check if the authenticated user is a student and if $user is an instance of Student
        elseif (auth()->guard('student')->check() && $user instanceof Student) {
            return $user->id==$userId;
        }
        // Check if the authenticated user is a parent and if $user is an instance of ParentStudent
        elseif (auth()->guard('parent')->check() && $user instanceof ParentStudent) {
            return $user->id==$userId;
        }
        // Check if the authenticated user is an admin and if $user is an instance of Admin
        elseif (auth()->guard('admin')->check() && $user instanceof Admin) {
            return true;
        }

        return false;
    }
}
