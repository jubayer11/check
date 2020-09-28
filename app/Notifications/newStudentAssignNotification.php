<?php

namespace App\Notifications;

use App\ClassHead;
use App\Lmsclass;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newStudentAssignNotification extends Notification
{
    use Queueable;

    public $subject,$classHead;
    public function __construct(ClassHead $classHead,Lmsclass $subject)
    {
        //
        $this->subject=$subject;
        $this->classHead=$classHead;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
             'data'=>'You have been assigned to',
             'subject_name'=>$this->subject->name,
             'title'=>$this->classHead->name,
             'path'=>$this->subject->path,
        ];
    }
}
