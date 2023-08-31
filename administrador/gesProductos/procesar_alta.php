<?php
include 'conexion.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_producto = isset($_POST["id_producto"]) ? $_POST["id_producto"] : '';
    $id_sucursal = isset($_POST["sucursal"]) ? $_POST["sucursal"] : '';
    $cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : '';

    // Validar los datos aquí si es necesario

    // Establecer la conexión a la base de datos
    $conexion = conectarBD();

    // Verificar si la conexión se estableció correctamente
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar el query para insertar en la tabla tinventarios
    $query = "INSERT INTO tinventarios (id_producto, id_sucursal, in_cantidad) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("iii", $id_producto, $id_sucursal, $cantidad);

    // Ejecutar el query de inserción
    if ($stmt->execute()) {
        echo "Producto dado de alta en la sucursal correctamente.";
    } else {
        echo "Error al dar de alta el producto en la sucursal: " . $stmt->error;
    }

    // Cerrar la sentencia y la conexión a la base de datos
    $stmt->close();
    $conexion->close();
} else {
    echo "Error: Método de solicitud incorrecto.";
}
?>
