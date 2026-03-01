<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'name', 'provider', 'description', 'career_path_id', 'mentor_id'];

    public function careerPath()
    {
        return $this->belongsTo(CareerPath::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function enrollments()
    {
        return $this->hasMany(TrainingEnrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'training_enrollments', 'training_id', 'user_id')
                    ->withTimestamps()
                    ->withPivot('id', 'status');
    }
}