<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewRegistrationNotification extends Notification
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
            ->greeting('There is a new registration in the system!')
            ->line('A new registration has been created, please follow the link to continue')
            ->action('View', route('registration.view', ['registrationID' => $this->registration->id]))
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
