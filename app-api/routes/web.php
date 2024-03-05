<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum'])->group(function(){
   
   
});

// Route::get('/alert.blade.php', [NotificationController::class, 'alert']);

// Route::get('/register', [UserController::class, 'registerView'])->name('register.view');
// Route::post('/register', [UserController::class, 'register'])->name('register');

// Route::get('/login', [UserController::class, 'loginView'])->name('login');
// Route::post('/login', [UserController::class, 'authorize'])->name('authorize');

// Route::get('/workouts', [WorkoutController::class, 'getUserWorkouts'])->name('workouts');
// // routes/web.php
// Route::post('/training/create', [WorkoutController::class, 'createWorkout'])->name('training.create');
// Route::get('/create/workout', 'WorkoutController@createWorkoutForm')->name('create.workout.form');
// Route::post('/store/workout', 'WorkoutController@storeWorkout')->name('store.workout');




