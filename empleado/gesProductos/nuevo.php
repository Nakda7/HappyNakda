<?php
include 'conexion.php';

// Establecer la conexión a la base de datos
$conexion = conectarBD();

// Verificar si la conexión se estableció correctamente
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se enviaron los datos de inserción
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de inserción
    $nombre = isset($_POST["pr_nombre"]) ? $_POST["pr_nombre"] : '';
    $descripcion = isset($_POST["pr_descripcion"]) ? $_POST["pr_descripcion"] : '';
    $precioCompra = isset($_POST["pr_precioCompra"]) ? $_POST["pr_precioCompra"] : '';
    $cantidad = isset($_POST["pr_cantidad"]) ? $_POST["pr_cantidad"] : '';
    $marca = isset($_POST["pr_marca"]) ? $_POST["pr_marca"] : '';
    $color = isset($_POST["pr_color"]) ? $_POST["pr_color"] : '';
    $gama = isset($_POST["pr_gama"]) ? $_POST["pr_gama"] : '';

    // Validar el valor de pr_precioCompra como número decimal
    if (!is_numeric($precioCompra)) {
        echo "Error: El precio de compra debe ser un número decimal válido.";
        exit();
    }

    // Preparar la consulta de inserción
    $query = "INSERT INTO tproductos (pr_nombre, pr_descripcion, pr_precioCompra, pr_cantidad, pr_marca, pr_color, pr_gama) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($query);

    // Vincular los parámetros
    $stmt->bind_param("ssdisss", $nombre, $descripcion, $precioCompra, $cantidad, $marca, $color, $gama);

    // Ejecutar la consulta de inserción
    if ($stmt->execute()) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error al agregar el producto: " . $stmt->error;
    }

    // Cerrar la sentencia
    $stmt->close();

    // Redireccionar de vuelta a la página de gestión de productos
    header("Location: gesProduc.php");
    exit();
} else {
    echo "Error: Método de solicitud incorrecto.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
