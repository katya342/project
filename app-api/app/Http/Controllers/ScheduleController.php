<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Workout;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
        public function getSchedule()
        {
            $user = Auth::user();
            $user_id = $user->id;
            $dates = Workout::where('user_id', $user_id)->pluck('date');
           
            return response()->json(['date' => $dates], 200);

        }
}
