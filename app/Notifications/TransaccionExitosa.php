<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransaccionExitosa extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($id_transaccion, $fecha_aprobacion, $creditos)
    {
        $this->id_transaccion = $id_transaccion;
        $this->fecha_aprobacion = $fecha_aprobacion;
        $this->creditos = $creditos;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/login');

        return (new MailMessage)
            ->line('Se ha aprobado el pago.')
            ->line('Se ha aceptado el pago en tu cuenta, ahora puedes publicar vacantes, tienes ' . $this->creditos . ' disponibles.')
            ->action('Iniciar sesion', $url)
            ->line('Gracias por utilizar nuestra plataforma!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
