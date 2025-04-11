<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function($notifiable, $url) {
            return (new MailMessage)
                ->greeting('¡Hola! 👋')
                ->subject('Por favor verifica tu cuenta')
                ->line('¡Estamos emocionados de tenerte con nosotros! Tu cuenta está casi lista.')
                ->line('Solo falta un paso más: haz clic en el siguiente botón para verificar tu dirección de correo electrónico.')
                ->action('Verificar mi cuenta', $url)
                ->line('Si no creaste una cuenta con nosotros, por favor ignora este mensaje.')
                ->salutation('¡Gracias por unirte a nosotros!')
                ->line('ADELSAR');
        });
    }
}
