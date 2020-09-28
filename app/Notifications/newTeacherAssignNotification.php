<?php

namespace App\Notifications;

use App\ClassHead;
use App\Lmsclass;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newTeacherAssignNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $subject;
    public function __construct(Lmsclass $subject)
    {
        $this->subject=$subject;

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
            'data'=>'You have been assigned to',
            'subject_name'=>$this->subject->name,
            'title'=>$this->subject->head->name,
            'path'=>$this->subject->path,
        ];
    }
}
