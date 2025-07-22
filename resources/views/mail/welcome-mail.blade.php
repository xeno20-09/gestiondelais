<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body,
        table,
        td {
            font-family: Helvetica, Arial, sans-serif;
        }

        .button {
            background-color: #2563eb;
            color: white !important;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }

        @media screen and (max-width: 600px) {
            .responsive-table {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #f3f4f6;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" valign="top" style="padding: 40px 0;">
                <table class="responsive-table" width="600" border="0" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td style="padding: 40px 30px;">
                            <!-- Logo -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <img src="https://i.ibb.co/NdS5LD4w/imbenin-removebg-preview.png" alt="Logo"
                                    style="height: 64px;">
                            </div>

                            <!-- Titre -->
                            <h1 style="color: #111827; font-size: 24px; text-align: center; margin-bottom: 30px;">
                                Bienvenue sur Gestion Delais
                            </h1>
                            <!-- Message de bienvenue -->
                            <p style="color: #4b5563; font-size: 16px; line-height: 24px; margin-bottom: 30px;">
                                Bonjour {{ $user['nom'] }} {{ $user['prenoms'] }},<br>
                                Votre compte a été créé avec succès.
                            </p>

                            <!-- Identifiants -->
                            <p style="color: #4b5563; font-size: 16px; margin-bottom: 10px;">
                                Voici vos identifiants de connexion :
                            </p>
                            <ul style="color: #4b5563; font-size: 16px; line-height: 24px; margin-bottom: 30px;">
                                <li><strong>Email :</strong> {{ $user->email }}</li>
                                <li><strong>Mot de passe temporaire :</strong> {{ $password }}</li>
                            </ul>

                            <!-- Alerte modification mot de passe -->
                            <p style="color: #b91c1c; font-weight: bold; font-size: 16px; margin-bottom: 30px;">
                                ⚠️ Pour votre sécurité, vous devez modifier ce mot de passe dès votre première
                                connexion.
                            </p>

                            <!-- Bouton de connexion -->
                            <p style="color: #6b7280; font-size: 14px; margin-top: 30px;">
                                Rendez vous sur,<br>
                            <p><a href="{{ url('/') }}">{{ url('/') }}</a></p>
                            </p>
                            <!-- Signature -->
                            <p style="color: #6b7280; font-size: 14px; margin-top: 30px;">
                                Cordialement,<br>
                                Gestion Delais - COUR SUPREME
                            </p>

                            <!-- Note -->
                            <p style="color: #9ca3af; font-size: 12px; margin-top: 30px;">
                                Ceci est un message automatique, merci de ne pas y répondre.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
