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
        VerifyEmail::toMailUsing( function($notifiable, $url){
            return (new MailMessage)
                ->greeting('¡Hola!')
                ->subject('Verificar Cuenta')
                ->line('Tu cuenta ya esta casi lista, solo da click en el siguiente botón.')
                ->action('Confirmar Cuenta', $url)
                ->line('Si no solicitaste este correo, puedes ignorar este mensaje.')
                ->salutation('Saludos')
                ;
        });
    }
}
