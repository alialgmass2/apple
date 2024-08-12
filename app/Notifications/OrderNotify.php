<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotify extends Notification
{
    use Queueable;
    private $title_en ;
    private $title_ar ;
    private $order_id ;
    private $user_id ;
    private $type ;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->order_id = $data['order_id']??'';
        $this->user_id = $data['user_id']??'';
        $this->type     = $data['type']??'';
        $this->title_en = $data['title_en']??'';
        $this->title_ar = $data['title_ar']??'';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
//    public function toMail(object $notifiable): MailMessage
//    {
//        $url = 'ata.com/bills'.$this->bill_id;
//        return (new MailMessage)
//                    ->subject('اضافة فاتورة جديدة')
//                    ->line('اضافة فاتورة جديدة')
//                    ->action('عرض الفاتورة', $url)
//                    ->line('شكرا لاستخدامك شركة ATA للبرمجيات');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'type' => $this->type,
        ];
    }

}
