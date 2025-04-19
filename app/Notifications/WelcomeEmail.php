<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmail extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bine ai venit în comunitatea noastră!')
            ->greeting('Felicitări, ' . $notifiable->name . '!')
            ->line('Îți mulțumim că ți-ai confirmat adresa de email.')
            ->line('Acum poți începe să folosești toate funcționalitățile aplicației noastre.')
            ->line('Accesează contul tău la acest link: ' . url('/dashboard'))
            ->line('Suntem aici să te ajutăm dacă ai nevoie de suport.');
    }
}
