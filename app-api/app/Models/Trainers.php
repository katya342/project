<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'surname', 'image_path', 'year_exp',
    ];
    public $timestamps = false; 
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function requests()
    {
        return $this->hasMany(Requests::class);
    }
    public function catalogs()
    {
        return $this->hasMany(Catalog::class);
    }
}
