<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReviewNotification extends Notification
{
    use Queueable;

    public Review $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $rating = str_repeat('★', $this->review->rating) . str_repeat('☆', 5 - $this->review->rating);

        return (new MailMessage)
            ->subject('Nouvelle évaluation reçue')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Un client vient de déposer une évaluation sur votre profil : ' . $rating)
            ->line('Commentaire : ' . ($this->review->comment ?: 'Aucun commentaire.'))
            ->action('Voir mon profil', route('transporteur.profile', $notifiable->id))
            ->line('Merci pour votre engagement !');
    }
}