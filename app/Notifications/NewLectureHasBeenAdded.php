<?php

namespace App\Notifications;

use App\Models\Lecture;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLectureHasBeenAdded extends Notification
{
    use Queueable;

    public $lecture;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Lecture $lecture)
    {
        $this->lecture = $lecture;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Новый доклад')
            ->line("На конференцию “{$this->lecture->conference->topic}” был подан доклад “{$this->lecture->topic}” от автора {$this->lecture->member->fullname}")
            ->line('Подтвердите или отклоните его участие, перейдя по ссылке: ')
            ->action('Открыть доклад', route('lectures.show', $this->lecture));
    }
}
