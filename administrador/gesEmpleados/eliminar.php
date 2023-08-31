<?php
include 'conexion.php';

// Establecer la conexión a la base de datos
$conexion = conectarBD();

// Verificar si la conexión se estableció correctamente
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se proporcionó el parámetro 'id_user'
if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    // Deshabilitar la restricción de clave externa
    $conexion->query("SET FOREIGN_KEY_CHECKS = 0");

    // Ejecutar la consulta para eliminar el usuario
    $query = "DELETE FROM tusers WHERE id_user = $id_user LIMIT 1";
    $result = $conexion->query($query);

    // Verificar si se eliminó el usuario exitosamente
    if ($result) {
        echo "Usuario eliminado exitosamente.";
        header("Location: gesEmple.php");
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }

    // Volver a habilitar la restricción de clave externa
    $conexion->query("SET FOREIGN_KEY_CHECKS = 1");
} else {
    echo "No se proporcionó el parámetro 'id_user'.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
