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
        $nombre = explode(' ', $notifiable->name)[0]; // Obtener solo el primer nombre

        return (new MailMessage)
            ->subject('✅ Pago aprobado - Ya puedes publicar vacantes')
            ->greeting("¡Hola {$nombre}!")
            ->line('Nos complace informarte que hemos procesado exitosamente tu pago y tu cuenta ha sido actualizada.')
            ->line('**Detalles de tu compra:**')
            ->line("🔹 **Créditos disponibles:** {$this->creditos}")
            ->line("🔹 **Fecha de aprobación:** " . now()->format('d/m/Y H:i'))
            ->line('')
            ->line('Ahora puedes comenzar a publicar tus vacantes y encontrar al mejor talento para tu equipo.')
            ->action('Publicar mi primera vacante', $url)
            ->line('')
            ->line('Si tienes alguna pregunta sobre el uso de tus créditos o necesitas asistencia, nuestro equipo está disponible para ayudarte:')
            ->line('📧 info@adelsar.hn')
            ->line('📞 +(504) 9522-5555')
            ->salutation('¡Gracias por confiar en nosotros!');
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
