<?php

namespace App\Notifications;

use App\Models\AppNotificationManager;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SystemNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $notificationId;

    public function __construct(int $notificationId)
    {
        $this->notificationId = $notificationId;
    }

    public function via()
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return AppNotificationManager::find($this->notificationId)->toArray();
    }
}
