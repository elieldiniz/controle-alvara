<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VencimentoAlvaraNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected \App\Models\Alvara $alvara)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): \Illuminate\Notifications\Messages\MailMessage
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('⚠️ Alerta de Vencimento: ' . $this->alvara->tipo)
                    ->greeting('Olá, ' . $notifiable->name)
                    ->line('Este é um lembrete automático de que um alvará está próximo ao vencimento.')
                    ->line('**Empresa:** ' . $this->alvara->empresa->nome)
                    ->line('**Tipo de Alvará:** ' . $this->alvara->tipo)
                    ->line('**Data de Vencimento:** ' . $this->alvara->data_vencimento->format('d/m/Y'))
                    ->action('Visualizar Alvará', route('alvaras.show', $this->alvara))
                    ->line('Recomendamos iniciar o processo de renovação para evitar multas ou interrupções.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'alvara_id' => $this->alvara->id,
            'empresa_nome' => $this->alvara->empresa->nome,
            'tipo' => $this->alvara->tipo,
            'data_vencimento' => $this->alvara->data_vencimento->toDateString(),
            'message' => 'Alvará Próximo ao Vencimento',
        ];
    }
}
