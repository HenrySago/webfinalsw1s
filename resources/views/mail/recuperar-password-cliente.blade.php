<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Recuperar contraseña</title>
</head>
<body>
    <p>Hola! {{ $cliente->nombres }} {{ $cliente->apellidos }} Se ha reportado que desea recuperar su contraseña.</p>
    <p>Estos son los datos del usuario:</p>
    <ul>
        <li>Nombre: {{ $cliente->nombres }} {{ $cliente->apellidos }}</li>
        <li>Celular: {{ $cliente->celular }}</li>
        <li>Correo: {{ $cliente->email }}</li>
    </ul>
    <p>Su codigo de recuperacion es:</p>
    <ul>
        <li>Codigo: <strong>{{ $cliente->codigoRecuperacion }}</strong></li>
    </ul>
</body>
</html>