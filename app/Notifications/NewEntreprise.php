<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewEntreprise extends Notification
{
    use Queueable;
    use Notifiable;
    private $temp;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($temp)
    {
        $this->temp = $temp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Une nouvelle entreprise a été créée.');
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
            'identifiant' => $this->temp->id,
            'role' => $this->temp->role_id,
            'nom' => $this->temp->nom,
            'sigle' => $this->temp->sigle,
            'prenom' => $this->temp->prenom,
            'email' => $this->temp->email,
            'ifu' => $this->temp->ifu,
            'password' => $this->temp->password,
            'adresse' => $this->temp->adresse,
            'sociale' => $this->temp->sociale,
            'pays' => $this->temp->pays,
            'description' => $this->temp->description,
            'tel' => $this->temp->tel,
            'fixe' => $this->temp->fixe,
            'code' => $this->temp->code,
            'message' => 'Une entreprise vient de sinscrire',
        ];
        $notifiable->notify(new NewEntreprise($this->temp));
    }
}
