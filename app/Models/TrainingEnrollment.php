<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingEnrollment extends Model
{
    use HasFactory;

    protected $table = 'training_enrollments';
    protected $fillable = ['training_id', 'user_id', 'status'];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
