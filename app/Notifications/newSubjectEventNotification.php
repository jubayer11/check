<?php

namespace App\Notifications;

use App\LmsclassEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newSubjectEventNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $event;
    public function __construct(LmsclassEvent $event)
    {
        //
        $this->event=$event;

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
            'subject_name' =>$this->event->lmsclass->name,
            'title'=>$this->event->name,
            'path'=> $this->event->lmsclass->path,
        ];
    }
}
