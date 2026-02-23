<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'bio',
        'university_id',
        'faculty_id',
        'career_path_id',
        'cv'
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function careerPath()
    {
        return $this->belongsTo(CareerPath::class);
    }

    /**
     * Mentorship Relationships
     */
    public function sentRequests()
    {
        return $this->hasMany(MentorshipRequest::class, 'user_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(MentorshipRequest::class, 'mentor_id');
    }

    public function mentees()
    {
        return $this->belongsToMany(User::class, 'mentorship_requests', 'mentor_id', 'user_id')
            ->wherePivot('status', 'approved');
    }

    public function mentors()
    {
        return $this->belongsToMany(User::class, 'mentorship_requests', 'user_id', 'mentor_id')
            ->wherePivot('status', 'approved');
    }

    protected static function booted()
    {
        static::deleting(function ($user) {
            // Manually clear mentorship requests if needed (although cascade should handle it)
            \App\Models\MentorshipRequest::where('user_id', $user->id)
                ->orWhere('mentor_id', $user->id)
                ->delete();
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
