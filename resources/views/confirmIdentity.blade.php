
    <h2>Bonjour, {{ $user['email'] }}</h2>
    <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td align="center">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="center">
                                    <p>Voici votre code de confirmation</p>
                                    <a class="button button-primary" target="_blank">{{ $code }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <p>Si vous n'êtes pas à l'origine de cette inscription, vous pouvez ignorer cet email.</p>


