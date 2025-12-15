
<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_inscripcion'])) {

    echo "<div style='background: #d4edda; padding: 15px; margin: 15px 0; border-radius: 5px;'>";
    echo "<h3>¡Procesando inscripción!</h3>";
    echo "<p>Fecha y hora en el servidor: " . date('d/m/Y H:i:s') . "</p>";
    echo "<p>IP del usuario: " . $_SERVER['REMOTE_ADDR'] . "</p>";
    echo "<p>Serás redirigido al formulario completo...</p>";
    echo "</div>";


}
?>