<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
        'ip_address',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Log an activity
     */
    public static function log(
        $userId,
        string $action,
        string $description,
        $model = null,
        array $oldValues = [],
        array $newValues = []
    ) {
        return self::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model ? $model->id : null,
            'old_values' => $oldValues ?: null,
            'new_values' => $newValues ?: null,
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Get user's recent activities
     */
    public static function userRecent($userId, $limit = 50)
    {
        return self::where('user_id', $userId)
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent activities across the system
     */
    public static function recent($limit = 100)
    {
        return self::latest()
            ->limit($limit)
            ->get();
    }
}
