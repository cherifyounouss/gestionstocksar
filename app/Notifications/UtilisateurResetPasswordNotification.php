<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UtilisateurResetPasswordNotification extends Notification
{
    use Queueable;

    //token handler
    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        //
        $this->token = $token;
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
        return (new MailMessage)
                    ->from('labo@sar.com')
                    ->subject('Réinitialisation de mot de passe')
                    ->greeting('Bonjour !')
                    ->line('Cet email vous permettra de réinitialiser votre mot de passe,')
                    ->line('Veuillez cliquer sur le boutton ci-dessous')
                    ->action('Réinitialiser mot de passe', url('utilisateur/reset', $this->token))
                    ->line('Si vous n\'avez pas demand&eacute; ceci, veuillez ignorez ce message');
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
