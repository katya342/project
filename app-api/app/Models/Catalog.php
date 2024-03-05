<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'difficulty',
        'image_path',
        'trainer_id',
    ];

    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }

    public function trainers()
    {
        return $this->hasMany(Trainers::class);
    }
}
