<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotivication extends Notification
{
    use Queueable;

    private $vendor_id;
    public function __construct($vendor_id)
    {
        $this->vendor_id = $vendor_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'vendor_id' => $this->vendor_id
        ];
    }
}
