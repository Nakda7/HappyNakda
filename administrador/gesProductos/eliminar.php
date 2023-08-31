<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="gesProduc.css">
</head>
<body>
    
    <h1>Eliminar Producto</h1>

    <?php
    include 'conexion.php';

    // Establecer la conexión a la base de datos
    $conexion = conectarBD();

    // Verificar si se recibió el ID del producto
    if (isset($_GET['id_producto'])) {
        $id_producto = intval($_GET['id_producto']); // Convertir a entero

        // Eliminar registros relacionados en la tabla 'tinventarios' que hacen referencia al producto
        $query_delete_inventarios = "DELETE FROM tinventarios WHERE id_producto = ?";
        $stmt_delete_inventarios = $conexion->prepare($query_delete_inventarios);
        $stmt_delete_inventarios->bind_param("i", $id_producto);
        if ($stmt_delete_inventarios->execute()) {
            // Los registros en 'tinventarios' relacionados han sido eliminados
        } else {
            echo "Error al eliminar los registros en 'tinventarios': " . $stmt_delete_inventarios->error;
            exit; // Detener la ejecución en caso de error
        }
        $stmt_delete_inventarios->close();

        // Eliminar el producto de la base de datos
        $query = "DELETE FROM tproductos WHERE id_producto = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $id_producto);
        if ($stmt->execute()) {
            echo "Producto eliminado correctamente.";
        } else {
            echo "Error al eliminar el producto: " . $stmt->error;
        }
        $stmt->close();
        $conexion->close();
    } else {
        echo "No se proporcionó el ID del producto.";
    }
    ?>

    <a href="gesProduc.php">Volver a la lista de productos</a>
</body>
</html>