<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'last_workout_check', 'remember_token', 'avatar',
    ];

    protected $hidden = [
        'password', 
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_user_relations');
    }
    public function workouts()
{
    return $this->belongsToMany(Workout::class, 'user_workout', 'user_id', 'workout_id');
}
    public function comments()
    {
        return $this->hasMany(WorkoutComment::class);
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);    
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function requests()
    {
        return $this->hasMany(Requests::class);
    }
}
