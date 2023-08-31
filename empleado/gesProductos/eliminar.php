<?php
include 'conexion.php';

// Establecer la conexión a la base de datos
$conexion = conectarBD();

// Verificar si la conexión se estableció correctamente
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se proporcionó el parámetro 'id_producto'
if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];

    // Escapar correctamente el valor del ID del producto
    $id_producto = mysqli_real_escape_string($conexion, $id_producto);

    // Eliminar el producto de la base de datos
    $query = "DELETE FROM tproductos WHERE id_producto = $id_producto";
    if (mysqli_query($conexion, $query)) {
        echo "Producto eliminado correctamente.";
        header("Location: gesProduc.php");
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }
} else {
    echo "No se proporcionó el parámetro 'id_producto'.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
