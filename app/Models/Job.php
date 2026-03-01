<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'job_listings';
    protected $fillable = ['title', 'company', 'career_path_id', 'mentor_id'];

    public function careerPath()
    {
        return $this->belongsTo(CareerPath::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
