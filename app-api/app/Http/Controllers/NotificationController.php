<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Auth;
// use App\Notifications\NewWorkoutNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewTrainingNotification;

class NotificationController extends Controller
{
    public function sendNewWorkoutNotification(Request $request)
    {
        $user = auth()->user();

        $user->notify(new NewTrainingNotification());

        
        return response()->json(['Notifications sent successfully' => $user], 200);
    }
    
}
