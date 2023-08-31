<?php
// Función para establecer la conexión a la base de datos
function conectarBD() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = "happynakda";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    return $conn;
}
?>
