<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvitationPaid extends Notification
{
    use Queueable;

    protected $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }



    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $url = url('/invate/confirm',$notifiable->remember_token);
        return (new MailMessage)
                    ->greeting('Hello!')
                    ->line('The invate notification.')
                    ->line('Login using your email and password')
                    ->line('Your password: '.$this->password)
                    ->action('Confirm invate', route('invite.confirm',$notifiable->remember_token))
                    ->line('Thank you for using our application!');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
