<?php
include 'conexion.php';

$conn = conectarBD();

// Consulta de selección
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Nombre: " . $row['us_nombre'] . "<br>";
        echo "Correo: " . $row['us_correo'] . "<br>";
        echo "Teléfono: " . $row['us_telefono'] . "<br>";
        echo "Contraseña: " . $row['us_contraseña'] . "<br>";
        echo "Tipo de cliente: " . $row['id_tipoCliente'] . "<br>";
        echo "CURP: " . $row['us_curp'] . "<br>";
        echo "-------------------------<br>";
    }
} else {
    echo "No se encontraron usuarios";
}

$conn->close();
?>
