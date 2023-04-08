<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table class="body-wrap" style="width: 100%; background-color: #f6f6f6;">
        <tbody>
            <tr>
                <td class="container" style="display: block; margin: 0 auto !important; max-width: 600px; padding: 10px;">
                    <table class="body" style="background-color: #fff; border-radius: 3px; width: 100%;">
                        <tbody>
                            <tr>
                                <td class="content" style="padding: 20px;">
                                <?php //dd($user) ?>
                                    <h2>Bonjour, {{ $user['prenom'].' '.$user['nom'] }}</h2>
                                    <p>Merci de vous être inscrit sur {{ config('app.name') }}.</p>
                                    <p>Si vous n'êtes pas à l'origine de cette inscription, vous pouvez ignorer cet email.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
