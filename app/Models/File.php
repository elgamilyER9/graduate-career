<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'path',
        'type',
        'mime_type',
        'size',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fileable()
    {
        return $this->morphTo();
    }

    /**
     * Get the file URL
     */
    public function getUrl()
    {
        return Storage::disk('public')->url($this->path);
    }

    /**
     * Delete the file from storage
     */
    public function deleteFromStorage()
    {
        if (Storage::disk('public')->exists($this->path)) {
            Storage::disk('public')->delete($this->path);
        }
        $this->delete();
    }

    /**
     * Get user's files of a specific type
     */
    public static function userFilesByType($userId, $type)
    {
        return self::where('user_id', $userId)
            ->where('type', $type)
            ->latest()
            ->get();
    }

    /**
     * Check if file type is allowed
     */
    public static function isAllowedType($type)
    {
        $allowed = ['resume', 'certificate', 'portfolio', 'cover_letter', 'document'];
        return in_array($type, $allowed);
    }

    /**
     * Check if MIME type is allowed
     */
    public static function isAllowedMimeType($mimeType)
    {
        $allowed = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'image/jpeg',
            'image/png',
            'image/gif',
        ];
        return in_array($mimeType, $allowed);
    }
}
