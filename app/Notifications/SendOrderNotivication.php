<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOrderNotivication extends Notification
{
    use Queueable;

    private $admin_id;
    private $status;
    public function __construct($admin_id, $status)
    {
        $this->admin_id = $admin_id;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'admin_id' => $this->admin_id,
            'status' => $this->status,
        ];
    }
}
