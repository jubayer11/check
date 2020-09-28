<?php

namespace App\Notifications;

use App\AllEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newAllEventNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $allEvent;
    public function __construct(AllEvent $allEvent)
    {
        //
        $this->allEvent=$allEvent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    public function toArray($notifiable)
    {
        return [
            'data'=>'you have a new Event',
            'subject_name' =>'some Subject',
            'title'=>$this->allEvent->name,
            'path'=> $this->allEvent->path,
        ];
    }
}
