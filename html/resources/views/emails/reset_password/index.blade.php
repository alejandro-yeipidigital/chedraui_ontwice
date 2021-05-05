<html>
<head>
    <title>Chedraui</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="font-family: Helvetica, sans-serif;">
    <table width="600px" style="margin: 0 auto; border-spacing: 0; background-color: #000; border: 1px solid #000;" align="center" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td style="background-color: #000;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #fff; width: 600px; background-color: #000;">
                                <img src="{{ asset('images/mailing/img_01.jpg') }}" alt="" border=”0” style="display: block;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #000;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #ffdf84; text-align: center; font-size: 3rem; width: 600px; background-color: #000; padding-top: 100px;">
                                <strong>Recuperar Contraseña</strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #fff; text-align: center; font-size: 1.5rem; width: 600px; background-color: #000; padding-top: 50px;">
                                Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #fff; text-align: center; font-size: 1rem; width: 600px; background-color: #000; padding : 50px;">
                                Este enlace de restablecimiento de contraseña caducará en 60 minutos.
                                <br>
                                Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #000;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="line-height: 0; font-size: 0; height: 71px; background-color: #000;">
                                <a href="{{ route('tickets.index') }}" target="_blank" style="display: inline-block;">
                                    <img src="{{ asset('images/mailing/Btn_Restablecer.png') }}" alt="Ir a la app" border=”0” style="display: inline-block; margin: 0 auto; width: 200px;">
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #000;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #fff; width: 600px; height: 50px; background-color: #000;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #000;">
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