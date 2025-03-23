<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url(config('app.url') . route('password.reset', $this->token, false));

        return (new MailMessage)
                    ->subject('Restablecer tu contraseña')
                    ->line('Recibimos una solicitud para restablecer tu contraseña.')
                    ->action('Restablecer contraseña', $url)
                    ->line('Si no solicitaste este cambio, puedes ignorar este correo.')
                    ->line('¡Gracias por usar nuestra aplicación!');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
