<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Send a notification to a user
     */
    public static function send(
        User $user,
        string $type,
        string $title,
        string $description,
        array $data = [],
        $notifiable = null
    ) {
        $notification = Notification::create([
            'user_id' => $user->id,
            'type' => $type,
            'title' => $title,
            'description' => $description,
            'data' => $data,
        ]);

        // Attach polymorphic relation if provided
        if ($notifiable) {
            $notification->notifiable()->associate($notifiable)->save();
        }

        return $notification;
    }

    /**
     * Notify multiple users
     */
    public static function sendToMany(
        array $userIds,
        string $type,
        string $title,
        string $description,
        array $data = [],
        $notifiable = null
    ) {
        $notifications = [];
        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user) {
                self::send($user, $type, $title, $description, $data, $notifiable);
            }
        }
        return $notifications;
    }

    /**
     * Notification types
     */
    public static function types()
    {
        return [
            'job_application_received' => __('Job Application Received'),
            'job_application_approved' => __('Job Application Approved'),
            'job_application_rejected' => __('Job Application Rejected'),
            'new_message' => __('New Message'),
            'mentorship_request_received' => __('Mentorship Request Received'),
            'mentorship_request_approved' => __('Mentorship Request Approved'),
            'training_enrollment' => __('Training Enrollment'),
            'training_completion' => __('Training Completed'),
            'mentor_profile_view' => __('Profile View'),
        ];
    }

    /**
     * Get notification icon
     */
    public static function getIcon(string $type): string
    {
        $icons = [
            'job_application_received' => 'bi-briefcase-fill',
            'job_application_approved' => 'bi-check-circle-fill',
            'job_application_rejected' => 'bi-x-circle-fill',
            'new_message' => 'bi-chat-dots-fill',
            'mentorship_request_received' => 'bi-person-fill',
            'mentorship_request_approved' => 'bi-check-circle-fill',
            'training_enrollment' => 'bi-mortarboard-fill',
            'training_completion' => 'bi-trophy-fill',
            'mentor_profile_view' => 'bi-eye-fill',
        ];

        return $icons[$type] ?? 'bi-bell-fill';
    }

    /**
     * Get notification color
     */
    public static function getColor(string $type): string
    {
        $colors = [
            'job_application_received' => 'info',
            'job_application_approved' => 'success',
            'job_application_rejected' => 'danger',
            'new_message' => 'primary',
            'mentorship_request_received' => 'warning',
            'mentorship_request_approved' => 'success',
            'training_enrollment' => 'info',
            'training_completion' => 'success',
            'mentor_profile_view' => 'secondary',
        ];

        return $colors[$type] ?? 'secondary';
    }
}
