<?php
include "conexion.php";

// Obtener el ID del producto a eliminar
$id_producto = $_POST["id_producto"];

// Eliminar el producto de la base de datos
$sql = "DELETE FROM tproductos WHERE id_producto='$id_producto'";

if ($conn->query($sql) === TRUE) {
    echo "Producto eliminado exitosamente.";
} else {
    echo "Error al eliminar el producto: " . $conn->error;
}

$conn->close();
?>
