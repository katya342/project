<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Trainers;

use Illuminate\Http\Request;

class TrainersController extends Controller
{
    public function getTrainers()
    {
        $trainers = Trainers::all();
        return response()->json(['trainers' => $trainers], 200);
    }

    public function getTrainerById($id)
    {
        $trainer = Trainers::find($id);
        if (!$trainer) {
            return response()->json(['error' => 'Trainer not found'], 404);
        } else {
            return response()->json(['message' => $trainer], 200);
        }
    }
    public function getTrainerByPlanId($planId)
    {
        $plan = Plan::find($planId);
        if (!$plan) {
            return response()->json(['error' => 'Plan does not exist'], 404);
        }
        $trainer = $plan->trainer; 
        if (!$trainer) {
            return response()->json(['error' => 'Trainer not found for this plan'], 404);
        }
        return response()->json(['trainer' => $trainer], 200);
    }
    
}
