<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Recuperar contraseña</title>
</head>
<body>
    <p>Hola! {{ $colaborador->nombres }} {{ $colaborador->apellidos }} Se ha reportado que desea recuperar su contraseña.</p>
    <p>Estos son los datos del colaborador:</p>
    <ul>
        <li>Nombre: {{ $colaborador->nombres }} {{ $colaborador->apellidos }}</li>
        <li>Celular: {{ $colaborador->celular }}</li>
        <li>Correo: {{ $colaborador->email }}</li>
    </ul>
    <p>Su codigo de recuperacion es:</p>
    <ul>
        <li>Codigo: <strong>{{ $colaborador->codigoRecuperacion }}</strong></li>
    </ul>
</body>
</html>