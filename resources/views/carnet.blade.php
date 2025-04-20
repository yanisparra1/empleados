<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    @php
        $mensajeLower = strtolower($mensaje);
        $color = 'green'; // Color por defecto para mensajes de éxito

        if (strpos($mensajeLower, 'empleado no está registrado') !== false) {
            $color = 'red';
        } elseif (strpos($mensajeLower, 'asistencia de entrada y salida registrada') !== false) {
            $color = 'blue';
        }
    @endphp

    <div class="bg-white p-8 rounded shadow-md text-center">
        <h2 class="text-2xl font-semibold text-{{ $color }}-600 mb-4">Mensaje</h2>
        <p class="text-gray-700">{{ $mensaje }}</p>
    </div>
</body>
</html>