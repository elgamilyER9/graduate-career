<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPath extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
