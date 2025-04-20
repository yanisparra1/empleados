<!DOCTYPE html>
<html>
<head>
    <title>Carnet de Identificación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .carnet {
            width: 170px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: center;
        }
        .carnet img.foto {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #007bff; /* Borde azul para la foto */
            margin-bottom: 5px; /* Reducido el margen inferior */
            object-fit: cover; /* Asegura que la imagen cubra el espacio sin deformarse */
        }
        .carnet img.logo {
            width: 80px;
            margin-bottom: 1px;
        }
        .carnet h1 {
            font-size: 15px;
            margin: 1px 0; /* Reducido el margen superior e inferior */
            color: #333;
        }
        .carnet p {
            font-size: 14px;
            margin: 3px 0;
            color: #555;
        }
        .carnet .qr-code {
            margin-top: 7px;
        }
        .carnet .qr-code img {
            width: 70px; /* Tamaño del código QR */
            height: 70px;
        }
        .carnet .header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 2px;
            margin-bottom: 3px;
        }
        .carnet .footer {
            margin-top: 3px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="carnet">
        <!-- Logo -->
        <div class="header">
        <h1>Misión Sucre</h1>
      </div>

        <!-- Foto -->
        <img src="{{ $imageSrc }}" alt="Foto de perfil" class="foto">

        <!-- Datos personales -->
        <h1>{{ $personal->nombre }} {{ $personal->apellido }}</h1>
        <p><strong>Cédula:</strong> {{ $personal->cedula }}</p>
        <p><strong>Cargo:</strong> {{ $personal->tipoPersonal->descripcion }}</p>

        <!-- Código QR -->
        <div class="qr-code">
            <img src="data:image/png;base64, {!! base64_encode($codigoQr) !!} " alt="Código QR">
        </div>

        <!-- Footer -->
        <div class="footer">
          
            <p>Carnet de Identificación</p>
        </div>
    </div>
</body>
</html>