<!DOCTYPE html>
<html>
<head>
    <title>Alta de Producto en Sucursales</title>
    <link rel="stylesheet" href="gesProduc.css">
</head>
<body>
    <h1>Alta de Producto en Sucursales</h1>

    <?php
    include 'conexion.php';

    // Establecer la conexión a la base de datos
    $conexion = conectarBD();

    // Verificar si se recibió el ID del producto
    if (isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];

        // Obtener la información del producto desde la tabla tproductos
        $query = "SELECT * FROM tproductos WHERE id_producto = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $producto = $result->fetch_assoc();

            // Mostrar el formulario para dar de alta productos en las sucursales
            echo '<h2>Dar de Alta en Sucursales</h2>';
            echo '<form action="procesar_alta.php" method="POST">';
            echo '<input type="hidden" name="id_producto" value="' . $producto['id_producto'] . '">';

            // Agregar campo para seleccionar la sucursal
            echo '<label for="sucursal">Sucursal:</label>';
            echo '<select name="sucursal" required>';
            echo '<option value="1">Sucursal 1</option>';
            echo '<option value="2">Sucursal 2</option>';
            echo '<option value="3">Sucursal 3</option>';
            echo '</select><br>';

            // Agregar campo para ingresar la cantidad
            echo '<label for="cantidad">Cantidad:</label>';
            echo '<input type="number" name="cantidad" required><br>';

            echo '<input type="submit" value="Dar de Alta">';
            echo '</form>';
        } else {
            echo "No se encontró el producto con el ID proporcionado.";
        }

        // Liberar el resultado y cerrar la conexión a la base de datos
        $stmt->close();
        $conexion->close();
    } else {
        echo "ID del producto no proporcionado.";
    }
    ?>
</body>
</html>
