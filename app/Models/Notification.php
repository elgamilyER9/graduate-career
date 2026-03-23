<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'description',
        'data',
        'read',
        'notifiable_type',
        'notifiable_id',
    ];

    protected $casts = [
        'data' => 'array',
        'read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function markAsRead()
    {
        $this->update(['read' => true]);
    }

    public function markAsUnread()
    {
        $this->update(['read' => false]);
    }

    /**
     * Get unread count for user
     */
    public static function unreadCount($userId)
    {
        return self::where('user_id', $userId)
            ->where('read', false)
            ->count();
    }

    /**
     * Get recent notifications
     */
    public static function recent($userId, $limit = 20)
    {
        return self::where('user_id', $userId)
            ->latest()
            ->limit($limit)
            ->get();
    }
}
