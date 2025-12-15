<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inscripción - IESTP MRAP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f4f6;
        }

        .header-top {
            background-color: #ffffff;
            border-bottom: 4px solid #16a34a;
        }

        .section-title {
            color: #15803d;
            font-weight: 700;
            border-left: 4px solid #f97316;
            padding-left: 10px;
        }

        .btn-submit {
            background-color: #16a34a;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background-color: #15803d;
        }

        #seccion-apoderado,
        #alerta-menor {
            display: none;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

    <header class="header-top py-4 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/1a/Logo_IESTP_MRAP.png"
                        onerror="this.src='https://via.placeholder.com/80?text=LOGO'" alt="Logo"
                        class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">IESTP María Rosario Araoz Pinto</h1>
                    <p class="text-xs text-gray-500">Formulario de Inscripción 2025</p>
                </div>
            </div>
            <a href="../index.html" class="text-gray-500 hover:text-green-600 text-sm font-medium"><i
                    class="fas fa-arrow-left"></i> Volver al Inicio</a>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 max-w-4xl flex-grow">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Ficha de Inscripción al Postulante</h2>
            <p class="text-center text-gray-500 mb-8 text-sm">Completa todos los campos obligatorios (*)</p>

            <form action="procesar_registro.php" method="POST" enctype="multipart/form-data" class="space-y-8">

                <!-- 1. DATOS DEL POSTULANTE -->
                <div>
                    <h3 class="section-title text-lg mb-4">1. Datos Personales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">DNI *</label>
                            <input type="text" name="dni" maxlength="8"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-green-500 focus:border-green-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Nacimiento *</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" onchange="validarEdad()"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-green-500 focus:border-green-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombres *</label>
                            <input type="text" name="nombres"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-green-500 focus:border-green-500"
                                required>
                        </div>
                        <!-- CORRECCIÓN: Nombres únicos para apellidos -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Apellido Paterno *</label>
                            <input type="text" name="apellido_paterno"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-green-500 focus:border-green-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Apellido Materno *</label>
                            <input type="text" name="apellido_materno"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-green-500 focus:border-green-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Edad *</label>
                            <input type="number" name="edad" id="input_edad" readonly
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2 bg-gray-100" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico *</label>
                            <input type="email" name="email"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-green-500 focus:border-green-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Celular *</label>
                            <input type="tel" name="celular" maxlength="9"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-green-500 focus:border-green-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dirección Domicilio *</label>
                            <input type="text" name="direccion_domicilio"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-green-500 focus:border-green-500"
                                required>
                        </div>
                    </div>
                </div>

                <!-- ALERTA MENOR DE EDAD -->
                <div id="alerta-menor" class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0"><i class="fas fa-exclamation-triangle text-orange-500"></i></div>
                        <div class="ml-3">
                            <p class="text-sm text-orange-700 font-bold">Postulante Menor de Edad Detectado</p>
                            <p class="text-sm text-orange-600">Al ser menor de 18 años, es obligatorio registrar los
                                datos del apoderado.</p>
                        </div>
                    </div>
                </div>

                <!-- 2. DATOS DEL APODERADO -->
                <div id="seccion-apoderado">
                    <h3 class="section-title text-lg mb-4">2. Datos del Apoderado (Padre/Madre)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">DNI Apoderado *</label>
                            <input type="text" name="dni_apoderado" id="input_dni_apoderado" maxlength="8"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombres Apoderado *</label>
                            <input type="text" name="nombre_apoderado" id="input_nombre_apoderado"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Apellido Paterno Apoderado
                                *</label>
                            <input type="text" name="apellido_paterno_apoderado" id="input_apellido_paterno_apoderado"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Apellido Materno Apoderado
                                *</label>
                            <input type="text" name="apellido_materno_apoderado" id="input_apellido_materno_apoderado"
                                class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                        </div>
                    </div>
                </div>

                <!-- 3. CARRERA -->
                <div>
                    <h3 class="section-title text-lg mb-4">3. Selección de Especialidad</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Carrera Técnica *</label>
                            <select name="carrera" class="w-full border-gray-300 rounded-md shadow-sm border p-2"
                                required>
                                <option value="">-- Seleccione --</option>
                                <option value="Contabilidad">Contabilidad</option>
                                <option value="Desarrollo de Sistemas">Desarrollo de Sistemas e Información</option>
                                <option value="Diseño Gráfico">Diseño Gráfico</option>
                                <option value="Mecánica Automotriz">Mecánica Automotriz</option>
                                <option value="Administración">Administración de Empresas</option>
                                <option value="Construcción Civil">Construcción Civil</option>
                                <option value="Diseño Publicitario">Diseño Publicitario</option>
                                <option value="Mecánica de Producción">Mecánica de Producción</option>
                                <option value="Secretariado">Secretariado Ejecutivo</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Turno *</label>
                            <select name="turno" class="w-full border-gray-300 rounded-md shadow-sm border p-2"
                                required>
                                <option value="diurno">Diurno (Mañana)</option>
                                <option value="nocturno">Nocturno (Noche)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 4. DOCUMENTACIÓN -->
                <div>
                    <h3 class="section-title text-lg mb-4">4. Carga de Documentos</h3>

                    <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-100">
                        <h4 class="font-bold text-blue-800 mb-2"><i class="fas fa-download mr-2"></i>Paso 1: Descarga
                            los formatos</h4>
                        <div class="flex flex-wrap gap-3">
                            <a href="../HTML/SoliDirec.html" target="_blank"
                                class="px-3 py-2 bg-white text-blue-600 text-sm font-medium rounded border border-blue-200 hover:bg-blue-100">
                                <i class="fas fa-file-pdf mr-1"></i> Solicitud al Director
                            </a>
                            <!-- Enlaces dinámicos -->
                            <a id="link-salud" href="../HTML/DeclaSalud.html" target="_blank"
                                class="px-3 py-2 bg-white text-green-600 text-sm font-medium rounded border border-green-200 hover:bg-green-50">
                                <i class="fas fa-file-medical mr-1"></i> DJ Salud (MAYOR)
                            </a>
                            <a id="link-dinero" href="../HTML/DeclaJuraMayor.html" target="_blank"
                                class="px-3 py-2 bg-white text-green-600 text-sm font-medium rounded border border-green-200 hover:bg-green-50">
                                <i class="fas fa-file-invoice-dollar mr-1"></i> DJ Dinero (MAYOR)
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <div class="border-b pb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto del DNI (Ambas caras)
                                *</label>
                            <input type="file" name="archivo_dni" accept=".pdf, .jpg, .png"
                                class="block w-full text-sm text-gray-500" required>
                        </div>
                        <div class="border-b pb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Voucher de Pago *</label>
                            <input type="file" name="archivo_voucher" accept=".pdf, .jpg, .png"
                                class="block w-full text-sm text-gray-500" required>
                        </div>
                        <div class="border-b pb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Certificado de Estudios *</label>
                            <input type="file" name="archivo_certificado" accept=".pdf, .jpg, .png"
                                class="block w-full text-sm text-gray-500" required>
                        </div>
                        <div class="bg-gray-50 p-4 rounded border border-gray-200">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Soli Direc. (Firmada)
                                    *</label>
                                <input type="file" name="archivo_soli_direc" accept=".pdf, .jpg" class="w-full" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">DJ de Salud (Firmada)
                                    *</label>
                                <input type="file" name="archivo_dj_salud" accept=".pdf, .jpg" class="w-full" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">DJ de Documentos / Dinero
                                    (Firmada) *</label>
                                <input type="file" name="archivo_dj_dinero" accept=".pdf, .jpg" class="w-full" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center pt-6">
                    <button type="submit"
                        class="btn-submit text-white font-bold py-3 px-10 rounded-lg text-lg w-full md:w-auto shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i> ENVIAR INSCRIPCIÓN
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-300 py-6 text-center text-sm mt-8">
        <p>&copy; 2025 IESTP María Rosario Araoz Pinto.</p>
    </footer>

    <script>
        function validarEdad() {
            const fechaInput = document.getElementById('fecha_nacimiento').value;
            const inputEdad = document.getElementById('input_edad'); // Referencia al input de edad
            if (!fechaInput) return;

            const fechaNac = new Date(fechaInput);
            const hoy = new Date();
            let edad = hoy.getFullYear() - fechaNac.getFullYear();
            const mes = hoy.getMonth() - fechaNac.getMonth();

            if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
                edad--;
            }

            // Asignar la edad calculada al input visible
            inputEdad.value = edad;

            const esMenor = edad < 18;
            const alertaMenor = document.getElementById('alerta-menor');
            const seccionApoderado = document.getElementById('seccion-apoderado');
            const inputsApoderado = seccionApoderado.querySelectorAll('input');
            const linkSalud = document.getElementById('link-salud');
            const linkDinero = document.getElementById('link-dinero');

            if (esMenor) {
                alertaMenor.style.display = 'block';
                seccionApoderado.style.display = 'block';
                inputsApoderado.forEach(input => input.required = true);

                linkSalud.href = "../HTML/DeclaJuraSaludMenor.html";
                linkSalud.innerHTML = '<i class="fas fa-file-medical mr-1"></i> DJ Salud (MENOR)';
                linkSalud.className = "px-3 py-2 bg-white text-orange-600 text-sm font-medium rounded border border-orange-200 hover:bg-orange-50";

                linkDinero.href = "../HTML/DeclaJuraMenor.html";
                linkDinero.innerHTML = '<i class="fas fa-file-invoice-dollar mr-1"></i> DJ Dinero (MENOR)';
                linkDinero.className = "px-3 py-2 bg-white text-orange-600 text-sm font-medium rounded border border-orange-200 hover:bg-orange-50";
            } else {
                alertaMenor.style.display = 'none';
                seccionApoderado.style.display = 'none';
                inputsApoderado.forEach(input => input.required = false);

                // Limpiar campos de apoderado si cambia de opinión
                inputsApoderado.forEach(input => input.value = '');

                linkSalud.href = "../HTML/DeclaSalud.html";
                linkSalud.innerHTML = '<i class="fas fa-file-medical mr-1"></i> DJ Salud (MAYOR)';
                linkSalud.className = "px-3 py-2 bg-white text-green-600 text-sm font-medium rounded border border-green-200 hover:bg-green-50";

                linkDinero.href = "../HTML/DeclaJuraMayor.html";
                linkDinero.innerHTML = '<i class="fas fa-file-invoice-dollar mr-1"></i> DJ Dinero (MAYOR)';
                linkDinero.className = "px-3 py-2 bg-white text-green-600 text-sm font-medium rounded border border-green-200 hover:bg-green-50";
            }
        }
    </script>
</body>

</html>