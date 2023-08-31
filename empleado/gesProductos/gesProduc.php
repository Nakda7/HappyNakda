<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_user'])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión o a otra página
    header('Location: ../../login/InSesion.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="gesProduc.css">
</head>
<body>
    <h1>Gestión de Productos</h1>

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
        $cantidad = isset($_POST["pr_cantidad"]) ? $_POST["pr_cantidad"] : '';
        $marca = isset($_POST["pr_marca"]) ? $_POST["pr_marca"] : '';
        $color = isset($_POST["pr_color"]) ? $_POST["pr_color"] : '';
        $gama = isset($_POST["pr_gama"]) ? $_POST["pr_gama"] : '';
        $id_categorias = isset($_POST["id_categorias"]) ? $_POST["id_categorias"] : '';
        $id_sucursal = isset($_POST["id_sucursal"]) ? $_POST["id_sucursal"] : '';
        $id_user = isset($_POST["id_user"]) ? $_POST["id_user"] : '';

        // Validar los datos aquí si es necesario

        // Insertar el nuevo producto en la base de datos
        $query = "INSERT INTO tproductos (pr_nombre, pr_descripcion, pr_precioCompra, pr_cantidad, pr_marca, pr_color, pr_gama, id_categorias, id_sucursal, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ssdissiiii", $nombre, $descripcion, $precioCompra, $cantidad, $marca, $color, $gama, $id_categorias, $id_sucursal, $id_user);
        if ($stmt->execute()) {
            echo "Producto agregado correctamente.";
        } else {
            echo "Error al agregar el producto: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    }
    ?>

    <h2>Agregar Producto</h2>
    <form action="nuevo.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="pr_nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" name="pr_descripcion" required><br>

        <label for="precioCompra">Precio de Compra:</label>
        <input type="number" step="0.01" name="pr_precioCompra" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="pr_cantidad" required><br>

        <label for="marca">Marca:</label>
        <input type="text" name="pr_marca" required><br>

        <label for="color">Color:</label>
        <input type="text" name="pr_color" required><br>

        <label for="gama">Gama:</label>
        <input type="text" name="pr_gama" required><br>

        <label for="id_categorias">ID Categorías:</label>
        <input type="text" name="id_categorias" required><br>

        <label for="id_sucursal">ID Sucursal:</label>
        <input type="text" name="id_sucursal" required><br>

        <label for="id_user">ID Usuario:</label>
        <input type="text" name="id_user" required><br>

        <input type="submit" value="Agregar Producto">
    </form>

    <h2>Productos registrados</h2>
    <?php
    // Obtener la lista de productos
    $query = "SELECT * FROM tproductos";
    $result = $conexion->query($query);

    // Verificar si se encontraron registros
    if ($result && $result->num_rows > 0) {
        // Mostrar la tabla de productos registrados
        echo '<table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio de Compra</th>
                        <th>Cantidad</th>
                        <th>Marca</th>
                        <th>Color</th>
                        <th>Gama</th>
                        <th>ID Categorías</th>
                        <th>ID Sucursal</th>
                        <th>ID Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['id_producto'] . '</td>
                    <td>' . $row['pr_nombre'] . '</td>
                    <td>' . $row['pr_descripcion'] . '</td>
                    <td>' . $row['pr_precioCompra'] . '</td>
                    <td>' . $row['pr_cantidad'] . '</td>
                    <td>' . $row['pr_marca'] . '</td>
                    <td>' . $row['pr_color'] . '</td>
                    <td>' . $row['pr_gama'] . '</td>
                    <td>' . $row['id_categorias'] . '</td>
                    <td>' . $row['id_sucursal'] . '</td>
                    <td>' . $row['id_user'] . '</td>
                    <td>
                        <a href="editar.php?id_producto=' . $row['id_producto'] . '">Editar</a>
                        <a href="eliminar.php?id_producto=' . $row['id_producto'] . '">Eliminar</a>
                    </td>
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo "No se encontraron productos registrados.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
    ?>

    <a href="gesProductos.php">Volver a la lista de productos</a>
</body>
</html>
