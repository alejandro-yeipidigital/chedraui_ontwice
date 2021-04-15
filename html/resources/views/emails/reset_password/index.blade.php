<html>
<head>
    <title>Quaker</title>
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
                            <td style="color: #eae34a; font-size: 35px; font-weight: bold; line-height: 1.2; width: 600px; height: 72px; text-align: center; background-image: url({{ asset('images/mailing/img_02.png') }})">
                                Recuperar Contraseña
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #fff; font-size: 16px; text-align: center; line-height: 1.4; width: 600px; height: 105px; padding: 0 100px; background-image: url({{ asset('images/mailing/img_03.png') }})">
                                Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.
                                <br><br>
                                    <a href="{{url('password/reset', $token)}}" style="color: #eae34a; font-weight: bold;">Reestablcer Contraseña</a>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #eae34a; font-size: 15px; text-align: center; line-height: 1.2; width: 600px; height: 96px; padding: 0 120px; background-image: url({{ asset('images/mailing/img_04.png') }})">
                                <br>
                                Este enlace de restablecimiento de contraseña caducará en 60 minutos.
                                <br>
                                Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff;">
                    <table style="margin: 0 auto; border-spacing: 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #fff; line-height: 1.4; text-align: center; width: 600px; height: 92px; background-image: url({{ asset('images/mailing/img_05.png') }})">
                                
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
                                <img src="{{ asset('images/mailing/img_06.png') }}" alt="" border=”0” style="display: block;">
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
                                <a href="{{ route('privacy') }}" style="text-decoration: none; color: #fff;">AVISO DE PRIVACIDAD </a>  |  <a href="{{ route('terms') }}" style="text-decoration: none; color: #fff;">TÉRMINOS Y CONDICIONES</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>