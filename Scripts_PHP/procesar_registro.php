<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Ingresopg";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Fallo en la conexión: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $dni = $_POST['dni'];
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $edad = $_POST['edad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion_domicilio'];

    $carrera = $_POST['carrera'];
    $turno = $_POST['turno'];


    $dni_apod = null;
    $nom_apod = null;
    $ape_pat_apod = null;
    $ape_mat_apod = null;


    $es_menor = ($edad < 18);

    if ($es_menor) {
        $dni_apod = $_POST['dni_apoderado'];
        $nom_apod = $_POST['nombre_apoderado'];
        $ape_pat_apod = $_POST['apellido_paterno_apoderado'];
        $ape_mat_apod = $_POST['apellido_materno_apoderado'];
    }


    $sql_estudiante = "INSERT INTO Estudiante (
        DNI, nombre, Apellido_Paterno, Apellido_Materno, edad, fecha_nacimiento, 
        Correo_Electronico, Celular, direccion_de_domicilio, 
        DNI_Apoderado, Nombre_del_Apoderado, Apellido_Paterno_del_apoderado, Apellido_Materno_del_apoderado
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql_estudiante);

    $stmt->bind_param(
        "isssississsss",
        $dni,
        $nombres,
        $apellido_paterno,
        $apellido_materno,
        $edad,
        $fecha_nacimiento,
        $email,
        $celular,
        $direccion,
        $dni_apod,
        $nom_apod,
        $ape_pat_apod,
        $ape_mat_apod
    );

    if ($stmt->execute()) {


        $archivo_dj_salud_blob = file_get_contents($_FILES['archivo_dj_salud']['tmp_name']);
        $archivo_dj_dinero_blob = file_get_contents($_FILES['archivo_dj_dinero']['tmp_name']);
        $archivo_dj_Certificado_blob = file_get_contents($_FILES['archivo_certificado']['tmp_name']);

        $null = null;

        $sql_docs = "INSERT INTO Documentos (
            No_devolucion_de_dinero_Menor_de_edad, 
            Declaracion_jurada_de_Salud_Menor_de__edad, 
            No_devolucion_de_dinero_Mayor_de_edad, 
            Declaracion_Jurada_de_salud_Mayor_de_edad,
            Certificado_Estudiante, 
            estudiante_DNI
        ) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt_docs = $conn->prepare($sql_docs);

        if ($es_menor) {

            $stmt_docs->bind_param("bbbbbi", $null,$null, $null, $null, $null, $dni);

            $stmt_docs->send_long_data(0, $archivo_dj_dinero_blob);
            $stmt_docs->send_long_data(1, $archivo_dj_salud_blob);
            $stmt_docs->send_long_data(4, $archivo_dj_Certificado_blob);  
        } else {

            $stmt_docs->bind_param("bbbbbi", $null, $null,$null, $null, $null, $dni);

            $stmt_docs->send_long_data(2, $archivo_dj_dinero_blob);
            $stmt_docs->send_long_data(3, $archivo_dj_salud_blob);
            $stmt_docs->send_long_data(4, $archivo_dj_Certificado_blob);
        }

        $stmt_docs->execute();
        $stmt_docs->close();


        $codigo_inscripcion = "INS-2025-" . $dni;

?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <title>Constancia de Inscripción</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <style>
                @media print {
                    .no-print {
                        display: none;
                    }

                    body {
                        background: white;
                    }

                    .ficha {
                        box-shadow: none;
                        border: 1px solid #ccc;
                    }
                }
            </style>
        </head>

        <body class="bg-gray-200 min-h-screen py-10">

            <div class="ficha max-w-2xl mx-auto bg-white p-8 md:p-12 shadow-2xl rounded-sm relative">


                <div class="flex justify-between items-center border-b-2 border-gray-800 pb-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="text-3xl text-green-700"><i class="fas fa-university"></i></div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900 uppercase">IESTP María Rosario Araoz Pinto</h1>
                            <p class="text-xs text-gray-500">San Miguel, Lima - Admisión 2025</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Código de Inscripción</div>
                        <div class="text-xl font-mono font-bold text-red-600"><?php echo $codigo_inscripcion; ?></div>
                    </div>
                </div>


                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">¡Registro Exitoso!</p>
                    <p>Los datos han sido guardados correctamente en la base de datos.</p>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 underline decoration-2 decoration-green-500 underline-offset-4">CONSTANCIA DE INSCRIPCIÓN</h2>
                </div>


                <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm text-gray-700 mb-6">
                    <div class="col-span-2 md:col-span-1">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Postulante</p>
                        <p class="text-lg font-medium text-gray-900"><?php echo "$apellido_paterno $apellido_materno, $nombres"; ?></p>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <p class="text-xs text-gray-500 uppercase font-semibold">DNI</p>
                        <p class="text-lg font-medium text-gray-900"><?php echo $dni; ?></p>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Carrera</p>
                        <p class="text-lg font-bold text-green-700"><?php echo strtoupper($carrera); ?></p>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Turno</p>
                        <p class="text-lg font-medium text-gray-900"><?php echo strtoupper($turno); ?></p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Dirección</p>
                        <p class="text-gray-900"><?php echo $direccion; ?></p>
                    </div>
                </div>


                <?php if ($es_menor): ?>
                    <div class='mt-4 p-3 bg-orange-50 border border-orange-200 rounded'>
                        <h3 class='font-bold text-orange-800 text-sm border-b border-orange-200 pb-1 mb-2'>DATOS DEL APODERADO</h3>
                        <p class='text-sm'><span class='font-semibold'>Nombre:</span> <?php echo "$nom_apod $ape_pat_apod $ape_mat_apod"; ?></p>
                        <p class='text-sm'><span class='font-semibold'>DNI:</span> <?php echo $dni_apod; ?></p>
                    </div>
                <?php endif; ?>

                <div class="mt-12 pt-4 border-t border-gray-300 text-center">
                    <div class="no-print flex justify-center gap-4 mt-6">
                        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow flex items-center gap-2 cursor-pointer">
                            <i class="fas fa-print"></i> Imprimir Constancia
                        </button>
                        <a href="../index.html" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded shadow flex items-center gap-2 cursor-pointer">
                            <i class="fas fa-home"></i> Finalizar
                        </a>
                    </div>
                </div>

            </div>
        </body>

        </html>
<?php

    } else {

        echo "<div style='color:red; text-align:center; margin-top:50px;'>";
        echo "<h1>Error al registrar:</h1>";
        echo "<p>" . $stmt->error . "</p>";
        echo "<a href='registro.html'>Volver al formulario</a>";
        echo "</div>";
    }

    $stmt->close();
    $conn->close();
} else {

    header("Location: registro.php");
    exit();
}
?>