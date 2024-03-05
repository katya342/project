<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function getAuthorizedUser(Request $request)
    {
        try {
            
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not authenticated',
                ], 401);
            }

            $userId = $user->id;
            $userName = $user->name;
            $userEmail = $user->email;
            $userLastWorkoutCheck = $user->last_workout_check;
            return response()->json([
                'status' => true,
                'user_id' => $userId,
                'user_name' => $userName,
                'user_email' => $userEmail,
                'last_check' => $userLastWorkoutCheck,
                'message' => 'User data retrieved successfully',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
