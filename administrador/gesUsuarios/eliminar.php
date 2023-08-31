<?php
include "conexion.php";

// Obtener el ID del producto a eliminar
$id_user = $_GET["id_user"];

// Eliminar el producto de la base de datos
$sql = "DELETE FROM tusers WHERE id_user='$id_user'";

$conn = conectarBD();

if ($conn->query($sql) === TRUE) {
    echo "Producto eliminado exitosamente.";
    header("Location: gesUsu.php");
} else {
    echo "Error al eliminar el producto: " . $conn->error;
}

$conn->close();
?>
