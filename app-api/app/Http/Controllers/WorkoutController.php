<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Workout;
use App\Models\Catalog;
use App\Models\WorkoutComment;
use App\Models\WorkoutImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ILLuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;

class WorkoutController extends Controller
{


    public function getUserWorkouts(Request $request)
    {
        try {
            // Получаем текущего пользователя
            $user = $request->user();
    
            // Получаем все тренировки пользователя, включая те, которые он когда-либо добавлял
            $workouts = $user->workouts()->withPivot('created_at')->get();
    
            // Возвращаем тренировки в формате JSON
            return response()->json(['workouts' => $workouts], 200);
        } catch (\Exception $e) {
            // В случае ошибки возвращаем сообщение об ошибке
            return response()->json(['message' => 'Ошибка при получении тренировок пользователя'], 500);
        }
    }

    
    public function getWorkout($id)
    {
        $workout = Workout::find($id);
        if (!$workout) {
            return response()->json(['error' => 'Workout not found'], 404);
        } else {
            return response()->json(['workout' => $workout], 200);
        }
    }

    
    public function addWorkoutToUser($workoutId)
    {
        try {
            $workout = Workout::findOrFail($workoutId);
            $user = auth()->user(); 
            $user->workouts()->attach($workoutId);

            return response()->json(['message' => $workout], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка при добавлении тренировки пользователю'], 500);
        }
    }


   

    public function deleteWorkout($id)
    {
        $user = Auth::user();
        $workout = Workout::find($id);

        if (!$workout) {
            return response()->json(['error' => 'Workout not found'], 404);
        }
        if (!$user) {
            return response()->json(['error' => 'User is not authorized'], 404);
        }


        $workout->delete();

        return response()->json(['message' => 'Workout deleted successfully'], 200);
    }
    
    




    public function checkForNewWorkout()
    {

        $newWorkouts = Workout::where('created_at', '>', auth()->user()->last_workout_check ?? null)->exists();
        if ($newWorkouts) {
            auth()->user()->update(['last_workout_check' => now()]);
        }

        return response()->json(['newWorkout' => $newWorkouts]);
    }

    public function findWorkoutsByCatalogId($catalogId)
    {
        try {
          
            $catalog = Catalog::findOrFail($catalogId);
            $workouts = $catalog->workouts()->get();
            
            // Возвращаем ответ с тренировками
            return response()->json(['workouts' => $workouts], 200);
        } catch (\Exception $e) {
            // В случае ошибки возвращаем сообщение об ошибке
            return response()->json(['message' => 'Ошибка при поиске тренировок'], 500);
        }
    }





}
