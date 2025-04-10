<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaTransaccion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($transaccion)
    {
        $this->transaccion = $transaccion;
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
        $url = url('/transaccion'); // URL al panel de administración

        return (new MailMessage)
            ->subject('⚠️ Nueva transacción recibida - Requiere revisión')
            ->greeting('Hola Administrador')
            ->line('Se ha registrado una nueva transacción en el sistema que requiere tu atención:')
            ->line('')
            ->line('**Detalles de la transacción:**')
            ->line('🔹 **ID de transacción:** #'.$this->transaccion->id)
            ->line('🔹 **Usuario:** '.$this->transaccion->user->name)
            ->line('🔹 **Monto:** $'.number_format($this->transaccion->monto, 2))
            ->line('🔹 **Método de pago:** Depósito bancario')
            ->line('🔹 **Fecha/hora:** '.now()->format('d/m/Y H:i'))
            ->line('') // Espacio en blanco
            ->line('**Acción requerida:**')
            ->line('Por favor verifica los detalles de esta transacción y completa el proceso según corresponda.')
            ->action('Revisar transacción', $url)
            ->line('') // Espacio en blanco
            ->line('Este es un mensaje automático. Por favor no respondas a este correo.')
            ->salutation('Saludos cordiales,');
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
