<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="gesProduc.css">
</head>
<body>
    
    <h1>Actualizar Producto</h1>

    <?php
    include 'conexion.php';

    // Establecer la conexión a la base de datos
    $conexion = conectarBD();

    // Verificar si se enviaron los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $id_producto = isset($_POST["id_producto"]) ? $_POST["id_producto"] : '';
        $nombre = isset($_POST["pr_nombre"]) ? $_POST["pr_nombre"] : '';
        $descripcion = isset($_POST["pr_descripcion"]) ? $_POST["pr_descripcion"] : '';
        $precioCompra = isset($_POST["pr_precioCompra"]) ? $_POST["pr_precioCompra"] : '';
        $marca = isset($_POST["pr_marca"]) ? $_POST["pr_marca"] : '';
        $color = isset($_POST["pr_color"]) ? $_POST["pr_color"] : '';
        $gama = isset($_POST["pr_gama"]) ? $_POST["pr_gama"] : '';

        // Validar el valor de pr_precioCompra como número decimal
        if (!is_numeric($precioCompra)) {
            echo "Error: El precio de compra debe ser un número decimal válido.";
            exit();
        }

        // Actualizar el producto en la base de datos
        $query = "UPDATE tproductos SET pr_nombre=?, pr_descripcion=?, pr_precioCompra=?, pr_marca=?, pr_color=?, pr_gama=? WHERE id_producto=?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ssdsssi", $nombre, $descripcion, $precioCompra, $marca, $color, $gama, $id_producto);
        if ($stmt->execute()) {
            echo "Producto actualizado correctamente.";
        } else {
            echo "Error al actualizar el producto: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error: Método de solicitud incorrecto.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
    ?>

    <a href="gesProduc.php">Volver a la lista de productos</a>
</body>
</html>
