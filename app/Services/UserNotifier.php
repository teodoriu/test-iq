<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserNotifier
{
    public function notify(User $user)
    {
        Log::info("Notifying user: {$user->email}");
        // Mail::to($user)->send(new SomeNotificationEmail());
    }
}