<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = ['title','provider','career_path_id'];

    public function careerPath()
    {
        return $this->belongsTo(CareerPath::class);
    }
}
