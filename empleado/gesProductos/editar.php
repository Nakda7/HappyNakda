<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Producto</title>
</head>
<body>
    <h1>Actualizar Producto</h1>

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

        // Verificar si se enviaron los datos de actualización
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario de actualización
            $nombre = isset($_POST["pr_nombre"]) ? $_POST["pr_nombre"] : '';
            $descripcion = isset($_POST["pr_descripcion"]) ? $_POST["pr_descripcion"] : '';
            $precioCompra = isset($_POST["pr_precioCompra"]) ? $_POST["pr_precioCompra"] : '';
            $cantidad = isset($_POST["pr_cantidad"]) ? $_POST["pr_cantidad"] : '';
            $marca = isset($_POST["pr_marca"]) ? $_POST["pr_marca"] : '';
            $color = isset($_POST["pr_color"]) ? $_POST["pr_color"] : '';
            $gama = isset($_POST["pr_gama"]) ? $_POST["pr_gama"] : '';

            // Validar los datos aquí si es necesario

            // Actualizar el producto en la base de datos
            $query = "UPDATE tproductos SET pr_nombre = ?, pr_descripcion = ?, pr_precioCompra = ?, pr_cantidad = ?, pr_marca = ?, pr_color = ?, pr_gama = ? WHERE id_producto = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("ssdisssi", $nombre, $descripcion, $precioCompra, $cantidad, $marca, $color, $gama, $id_producto);
            if ($stmt->execute()) {
                echo "Producto actualizado correctamente.";
                header("Location: gesProduc.php");
            } else {
                echo "Error al actualizar el producto: " . $stmt->error;
            }

            // Cerrar la sentencia
            $stmt->close();
        }

        // Obtener los datos actuales del producto
        $query = "SELECT * FROM tproductos WHERE id_producto = $id_producto";
        $result = $conexion->query($query);

        // Verificar si se obtuvieron los datos del producto exitosamente
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Aquí puedes utilizar los datos del producto para cargar los campos de actualización en tu formulario
            $nombre = $row['pr_nombre'];
            $descripcion = $row['pr_descripcion'];
            $precioCompra = $row['pr_precioCompra'];
            $cantidad = $row['pr_cantidad'];
            $marca = $row['pr_marca'];
            $color = $row['pr_color'];
            $gama = $row['pr_gama'];

            // Mostrar el formulario de actualización con los datos del producto cargados
            ?>
            <form action="editar.php?id_producto=<?php echo $id_producto; ?>" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="pr_nombre" value="<?php echo $nombre; ?>" required><br>
                <label for="descripcion">Descripción:</label>
                <input type="text" name="pr_descripcion" value="<?php echo $descripcion; ?>" required><br>
                <label for="precioCompra">Precio de Compra:</label>
                <input type="number" step="0.01" name="pr_precioCompra" value="<?php echo $precioCompra; ?>" required><br>
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="pr_cantidad" value="<?php echo $cantidad; ?>" required><br>
                <label for="marca">Marca:</label>
                <input type="text" name="pr_marca" value="<?php echo $marca; ?>" required><br>
                <label for="color">Color:</label>
                <input type="text" name="pr_color" value="<?php echo $color; ?>" required><br>
                <label for="gama">Gama:</label>
                <input type="text" name="pr_gama" value="<?php echo $gama; ?>" required><br>
                <input type="submit" value="Actualizar">
            </form>
            <?php
        } else {
            echo "No se encontró el producto.";
        }
    } else {
        echo "No se proporcionó el parámetro 'id_producto'.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
    ?>
</body>
</html>
