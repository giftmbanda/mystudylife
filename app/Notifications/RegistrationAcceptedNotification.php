<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegistrationAcceptedNotification extends Notification
{
    use Queueable;

    protected $registration;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($registration)
    {
        $this->registration = $registration;
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
        $message = new MailMessage();
        $message->subject(config('settings.mailSubject'))
            ->greeting('Hello ' . $this->registration->student_title . ' ' . $this->registration->student_surname . ', Registration Approved!')
            ->line('Your recent registration has been approved, you can keep up to date with everything by checking your calendar, and course content on your dashboard once you are logged in, please follow the link to continue')
            ->action('Dashboard', route('user.dashboard'))
            ->line('Thank you!');

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
