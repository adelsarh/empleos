<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoCandidato extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($id_vacante, $nombre_vacante, $usuario_id)
    {
        $this->id_vacante = $id_vacante;
        $this->nombre_vacante = $nombre_vacante;
        $this->usuario_id = $usuario_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/notificaciones');

        return (new MailMessage)
            ->subject('¡Nuevo candidato para tu vacante!')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line('Tenemos buenas noticias: has recibido un nuevo candidato para tu vacante.')
            ->line('**Vacante:** ' . $this->nombre_vacante)
            ->action('Revisar candidato', $url)
            ->line('No dejes pasar esta oportunidad de encontrar al talento ideal.')
            ->salutation('Saludos,')
            ->line('El equipo de ' . config('app.name'));
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'id_vacante' => $this->id_vacante,
            'nombre_vacante' => $this->nombre_vacante,
            'usuario_id' => $this->usuario_id
        ];
    }
}
