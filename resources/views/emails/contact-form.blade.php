<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; margin: 0; padding: 0; background: #f3f4f6;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background: #f3f4f6; padding: 32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,.08);">
                    <tr>
                        <td style="background: #4f46e5; padding: 24px 32px;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 20px;">Nouveau message de contact</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 32px;">
                            <p style="margin: 0 0 16px;"><strong>De :</strong> {{ $details['name'] }} ({{ $details['email'] }})</p>
                            <p style="margin: 0 0 16px;"><strong>Sujet :</strong> {{ $details['subject'] }}</p>
                            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 24px 0;">
                            <p style="margin: 0; line-height: 1.6; white-space: pre-line;">{{ $details['message'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 16px 32px; background: #f9fafb; color: #9ca3af; font-size: 12px;">
                            Ce message a été envoyé depuis le formulaire de contact de TransportLink Maroc.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>