<html>
<head>
    <title>Saladitas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="font-family: Helvetica, sans-serif;">
    <table width="600px" style="margin: 0 auto; border-spacing: 0; background-color: #fff; border: 1px solid #000;" align="center" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td style="background-color: #fff;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="line-height: 0; font-size: 0;">
                                <img src="{{ asset('images/mailing/img_01.png') }}" alt="" border=”0” style="display: block;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #333081; font-weight: bold; font-size: 16px; text-align: center; line-height: 1.4; width: 600px; height: 174px; padding: 0 100px; background-image: url({{ asset('images/mailing/img_02.png') }})">
                                Felicidades
                                <br><br>
                                Hola {{ $user->name }},
                                <br>
                                Te tenemos grandes noticias, el ticket de compra "#{{ $participation->ticket_code }}" que registraste recientemente ha sido validado con éxito.
                                <br>
                                !Sigue Participando!
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #fff; line-height: 1.4; text-align: center; width: 600px; height: 50px; background-image: url({{ asset('images/mailing/img_03.png') }})">
                                <a href="{{ route('tickets.index') }}" target="_blank" style="display: inline-block;">
                                    <img src="{{ asset('images/mailing/btn.png') }}" alt="Login" border=”0” style="display: inline-block; margin: 0 auto; width: 200px;">
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="line-height: 0; font-size: 0;">
                                <img src="{{ asset('images/mailing/img_04.png') }}" alt="" border=”0” style="display: block;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #1e2953;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #fff; font-size: 9px; text-align: center; padding: 0 100px; line-height: 1.4; width: 600px; height: 23px;">
                                <a href="{{ route('privacy') }}" style="text-decoration: none; color: #fff;">AVISO DE PRIVACIDAD </a> | <a href="{{ route('terms') }}" style="text-decoration: none; color: #fff;">TÉRMINOS Y CONDICIONES</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>