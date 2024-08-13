@component('mail::message')
    # Solicitud de Restablecimiento de Contraseña

    Hola,

    Has recibido este correo porque se ha solicitado el restablecimiento de la contraseña para tu cuenta.

    @component('mail::button', ['url' => $resetUrl])
        Restablecer Contraseña
    @endcomponent

    Este enlace para restablecer la contraseña expirará en 60 minutos.

    Si no solicitaste el restablecimiento de la contraseña, no es necesario tomar ninguna medida adicional.

    Saludos,
    {{ config('app.name') }}

    Si tienes problemas para hacer clic en el botón "Restablecer Contraseña", copia y pega la siguiente URL en tu navegador:
    {{ $resetUrl }}
@endcomponent
