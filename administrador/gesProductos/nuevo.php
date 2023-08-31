<?php
include 'conexion.php';

// Establecer la conexión a la base de datos
$conexion = conectarBD();

// Verificar si la conexión se estableció correctamente
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = isset($_POST["pr_nombre"]) ? $_POST["pr_nombre"] : '';
    $descripcion = isset($_POST["pr_descripcion"]) ? $_POST["pr_descripcion"] : '';
    $precioCompra = isset($_POST["pr_precioCompra"]) ? $_POST["pr_precioCompra"] : '';
    $marca = isset($_POST["pr_marca"]) ? $_POST["pr_marca"] : '';
    $color = isset($_POST["pr_color"]) ? $_POST["pr_color"] : '';
    $gama = isset($_POST["pr_gama"]) ? $_POST["pr_gama"] : '';

    // Validar los datos aquí si es necesario

    // Query de inserción de datos
    $query = "INSERT INTO tproductos (pr_nombre, pr_descripcion, pr_precioCompra, pr_marca, pr_color, pr_gama) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Preparar la consulta
    $stmt = $conexion->prepare($query);

    // Vincular los parámetros
    $stmt->bind_param("ssdiss", $nombre, $descripcion, $precioCompra,  $marca, $color, $gama);
    
    // Ejecutar la consulta de inserción
    if ($stmt->execute()) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error al agregar el producto: " . $stmt->error;
    }

    // Cerrar la sentencia
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
