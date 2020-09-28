<?php

namespace App\Notifications;

use App\Assaignment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newAssignmentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $ass;
    public function __construct(Assaignment $ass)
    {
        //
        $this->ass = $ass;
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
            'data'=>'you have a new Assignment',
            'subject_name' => $this->ass->lmsclass->name,
            'title'=>$this->ass->title,
            'path'=> $this->ass->lmsclass->path,
            'deadline'=>$this->ass->deadline,
        ];
    }
}
