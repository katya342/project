<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'duration_months',
        'trainer_id',
    ];
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
    public function trainer()
    {
        return $this->belongsTo(Trainers::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
