<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
    <link rel="stylesheet" href="gesProduc.css">
</head>
<body>
    
    <h1>Editar Producto</h1>

    <?php
    include 'conexion.php';

    // Establecer la conexión a la base de datos
    $conexion = conectarBD();

    // Verificar si se recibió el ID del producto
    if (isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];

        // Obtener los datos actuales del producto
        $query = "SELECT * FROM tproductos WHERE id_producto = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró el producto
        if ($result && $result->num_rows == 1) {
            $producto = $result->fetch_assoc();

            // Mostrar el formulario de edición con los datos actuales del producto
            ?>
            <form action="actualizar.php" method="POST">
                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" name="pr_nombre" value="<?php echo $producto['pr_nombre']; ?>" required><br>

                <label for="descripcion">Descripción:</label>
                <input type="text" name="pr_descripcion" value="<?php echo $producto['pr_descripcion']; ?>" required><br>

                <label for="precioCompra">Precio de Compra:</label>
                <input type="number" step="0.01" name="pr_precioCompra" value="<?php echo $producto['pr_precioCompra']; ?>" required><br>

                <label for="marca">Marca:</label>
                <input type="text" name="pr_marca" value="<?php echo $producto['pr_marca']; ?>" required><br>

                <label for="color">Color:</label>
                <input type="text" name="pr_color" value="<?php echo $producto['pr_color']; ?>" required><br>

                <label for="gama">Gama:</label>
                <input type="text" name="pr_gama" value="<?php echo $producto['pr_gama']; ?>" required><br>

                <input type="submit" value="Actualizar Producto">
            </form>
            <?php
        } else {
            echo "No se encontró el producto con el ID proporcionado.";
        }

        // Cerrar la conexión a la base de datos
        $stmt->close();
        $conexion->close();
    } else {
        echo "No se proporcionó el ID del producto.";
    }
    ?>

    <a href="gesProductos.php">Volver a la lista de productos</a>
</body>
</html>
