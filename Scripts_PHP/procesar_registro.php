<?php
// procesar_registro.php
// Este archivo recibe los datos del formulario (registro.php)

// Verificamos si se enviaron datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Recibimos los datos básicos
    $dni = $_POST['dni'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];
    $carrera = $_POST['carrera'];

    // 2. Calculamos la edad (Validación de Servidor - Backend)
    $fecha_nac = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nac)->y;

    // 3. Verificamos si es menor de edad y recibimos datos del apoderado
    $es_menor = ($edad < 18);
    $datos_apoderado = "";

    if ($es_menor) {
        $nombre_apoderado = $_POST['nombre_apoderado'];
        $dni_apoderado = $_POST['dni_apoderado'];
        $datos_apoderado = "<li><strong>Apoderado:</strong> $nombre_apoderado (DNI: $dni_apoderado)</li>";
    }

    // 4. Mostrar respuesta visual (Simulación de éxito)
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Registro Recibido</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full border-t-4 border-green-500">
            <div class="text-center mb-6">
                <div class="inline-block p-3 rounded-full bg-green-100 text-green-500 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">¡Inscripción Recibida!</h1>
                <p class="text-gray-600 mt-2">Hemos recibido tus datos correctamente.</p>
            </div>

            <div class="bg-gray-50 p-4 rounded text-sm text-gray-700 mb-6">
                <ul class="space-y-2">
                    <li><strong>Postulante:</strong> <?php echo "$nombres $apellidos"; ?></li>
                    <li><strong>DNI:</strong> <?php echo $dni; ?></li>
                    <li><strong>Carrera:</strong> <?php echo strtoupper($carrera); ?></li>
                    <li><strong>Edad detectada:</strong> <?php echo $edad; ?> años</li>
                    <?php echo $datos_apoderado; ?>
                </ul>
            </div>

            <div class="text-center">
                <a href="index.php" class="text-green-600 font-semibold hover:underline">Volver al inicio</a>
            </div>
        </div>
    </body>

    </html>
<?php

} else {
    // Si alguien intenta entrar directo a este archivo sin llenar el formulario
    header("Location: registro.php");
    exit();
}
?>