<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function storeRequest(Request $request, $trainerId)
    {
        $user = Auth::user();
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request = \App\Models\Requests::create([
            "user_name"=> $request->user_name,
            "phone" => $request->phone,
            "email" => $request->email,
            "trainer_name" => $request->trainer_name,
            'user_id' => $user->id,
            'trainer_id' => $trainerId,

        ]);

        return response()->json(['success' => $request], 200);

    }
    public function getRequest()
    {
        $user = Auth::user();
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request = \App\Models\Requests::where('user_id', $user->id)->get();
        return response()->json(['success'=> $request], 200);
    }
    public function changeStatus($reqId)
    {
        $user = Auth::user();
        $request = \App\Models\Requests::find($reqId);
        $request->status = 'deleted';
        try {
            $request->delete();
            return response()->json(['success' => 'Notification status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update notification status'], 500);
        }
    }
}
