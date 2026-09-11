<?php

namespace App\Notifications;

class NotificationChannels
{
    /**
     * Canaux actifs pour les notifications métier.
     *
     * La base de données est toujours utilisée. L'email n'est ajouté que si
     * un serveur SMTP réellement configuré est disponible (identifiants non
     * vides et différents des valeurs d'exemple du .env).
     */
    public static function available(): array
    {
        if (config('mail.default') === 'smtp' && ! empty(config('mail.mailers.smtp.username')) && ! empty(config('mail.mailers.smtp.password'))) {
            $username = (string) config('mail.mailers.smtp.username');
            $password = (string) config('mail.mailers.smtp.password');

            $placeholders = [
                'TON_MAILTRAP_USERNAME',
                'TON_NOUVEAU_MOT_DE_PASSE',
            ];

            if (! in_array($username, $placeholders, true) && ! in_array($password, $placeholders, true)) {
                return ['database', 'mail'];
            }
        }

        return ['database'];
    }
}