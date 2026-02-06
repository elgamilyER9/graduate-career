<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = ['name','career_path_id'];

    public function careerPath()
    {
        return $this->belongsTo(CareerPath::class);
    }
}
