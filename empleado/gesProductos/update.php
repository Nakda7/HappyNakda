<?php
include "conexion.php";

// Obtener los datos del formulario
$id_producto = $_POST["id_producto"];
$pr_nombre = $_POST["pr_nombre"];
$pr_descripcion = $_POST["pr_descripcion"];
$pr_precioCompra = $_POST["pr_precioCompra"];
$pr_cantidad = $_POST["pr_cantidad"];
$pr_marca = $_POST["pr_marca"];
$pr_color = $_POST["pr_color"];
$pr_gama = $_POST["pr_gama"];

// Actualizar el producto en la base de datos
$sql = "UPDATE tproductos SET pr_nombre='$pr_nombre', pr_descripcion='$pr_descripcion', pr_precioCompra='$pr_precioCompra', pr_cantidad='$pr_cantidad', pr_marca='$pr_marca', pr_color='$pr_color', pr_gama='$pr_gama' WHERE id_producto='$id_producto'";

if ($conn->query($sql) === TRUE) {
    echo "Producto actualizado exitosamente.";
} else {
    echo "Error al actualizar el producto: " . $conn->error;
}

$conn->close();
?>
