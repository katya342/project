<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function subscribe(Request $request, $planId)
    {
        $plan = Plan::find($planId);
        if(!$plan)
        {
            return response()->json(['error' => 'Plan not found'], 404);
        }
        $user = $request->user();
        if(!$user)
        {
            return response()->json(['error' => 'User not found']);
        }

        if ($user->subscriptions()->where('plan_id', $planId)->exists()) {
            return response()->json(['error' => 'Already subscribed to this plan'], 400);
        }
        $duration = $plan->duration_month;
        $subscription = new Subscription([
            'user_id' => $user->id,
            'plan_id' => $planId,
            'expires_at' => now()->addMonth(),
            'active' => true,

        ]);

        $subscription->save();
        return response()->json(['success' => true, 'message' => 'Subscription successful']);
    }
    public function deleteSubscribe($id) 
    {
        try{
            $subscriptions = Subscription::where('user_id', $id)-> get();
            foreach ($subscriptions as $subscription) {
                $subscription->delete();
            }
    
            return response()->json(['message' => 'Subscriptions deleted successfully']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete subscriptions', 'details' => $e->getMessage()], 500);
        }
       
    }



    
    public function unsubscribe(Request $request, $subId)
    {
        $user = $request->user();
        if(!$user)
        {
            return response()->json(['error' => 'User not found'], 404);
        }

        $subsctiption = Subscription::find($subId);
        if(!$subsctiption)
        {
            return response()->json(['error' => 'Subscription not found'], 404);
        }
        if($subsctiption->user_id !== $user->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $subsctiption->update(['active' => false]);
        return response()->json(['success' => true, 'message' => 'Subscription canceled successfully']);
    }
    public function getAvailablePlans()
    {
        $plans = Plan::all();
        return response()->json(['All plans: ' => $plans]);
    }
    
    // public function getPlan
   
    public function getActiveSubs(Request $request)
    {
        $user = $request->user();
        if(!$user)
        {
            return response()->json(['Message' => 'User not found'], 404);
        }
        $activeSubs = $user->subscriptions()->where('active', true)->get();
        return response()->json(['success' => $activeSubs], 200);
    }
    public function getUnactiveSubs(Request $request)
    {
        $user = $request->user();
        if(!$user)
        {
            return response()->json(['Message' => 'User not found'], 404);
        }
        $unActiveSubs = $user->subscriptions()->where('active', false)->get();
        return response()->json(['success' => $unActiveSubs], 200);

    }
}
