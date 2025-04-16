<?php

namespace App\Http\Controllers;

use App\Services\UserNotifier;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function notify(UserNotifier $notifier)
    {
        $notifier->notify(auth()->user());
    }

}
