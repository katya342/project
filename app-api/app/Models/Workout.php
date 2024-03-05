<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id', 'title', 'description', 'date',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workout', 'workout_id', 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(WorkoutComment::class);
    }
    public function images()
    {
        return $this->hasMany(WorkoutImage::class);
    }

    public function videos()
    {
        return $this->hasMany(Catalog::class);
    }
    public function catalogs()
    {
        return $this->belongsTo(Catalog::class);
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

}
