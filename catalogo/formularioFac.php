<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        input[type="submit"] {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    
</head>
<body>

<div class="container">
    <h1>Formulario de Factura</h1>

<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_user'])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión o a otra página
    header('Location: ../login/login.php');
    exit();
}

// Establecer la conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '12345', 'happynakda');

// Verificar la conexión
if (!$conn) {
    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
}

// Obtener el id de usuario de la sesión
$id_user = $_SESSION['id_user'];

// Consulta para obtener los datos relevantes de la tabla tcarritos
$query = "SELECT tproductos.pr_nombre, tproductos.pr_precioCompra, tcarritos.c_quantity, tinventarios.id_sucursal
          FROM tcarritos
          INNER JOIN tproductos ON tcarritos.id_producto = tproductos.id_producto
          INNER JOIN tinventarios ON tcarritos.id_producto = tinventarios.id_producto AND tinventarios.id_sucursal = tcarritos.id_sucursal
          WHERE tcarritos.id_user = $id_user";

$result = mysqli_query($conn, $query);

// Verificar si se encontraron registros
if ($result && mysqli_num_rows($result) > 0) {
    // Inicializar un array para almacenar todos los productos del carrito
    $productosCarrito = array();

    // Obtener todos los registros y guardarlos en el array $productosCarrito
    while ($row = mysqli_fetch_assoc($result)) {
        $productosCarrito[] = $row;
    }

    // Cerrar el resultado del query, ya no lo necesitamos
    mysqli_free_result($result);
} else {
    // No se encontraron registros en la tabla tcarritos
    echo 'No se encontraron productos en el carrito.';
}

$delete_query = "DELETE FROM tcarritos WHERE id_user = $id_user";
mysqli_query($conn, $delete_query);

mysqli_close($conn);

?>

<form method="post" action="generarFact.php">
    <label for="nombre">Nombre del Cliente:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="direccion">Dirección del Cliente:</label>
    <input type="text" id="direccion" name="direccion" required>

    <label for="fecha">Fecha de Factura:</label>
<input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly>


    <label for="telefono">Número de Teléfono:</label>
    <input type="tel" id="telefono" name="telefono" required>
    <label for="rfc">RFC del Cliente:</label>
        <input type="text" id="rfc" name="rfc" required>

    <label for="metodoPago">Método de Pago:</label>
    <select id="metodoPago" name="metodoPago" required>
        <option value="efectivo">Efectivo</option>
        <option value="tarjeta">Tarjeta de Crédito/Débito</option>
        <option value="transferencia">Transferencia Bancaria</option>
        <!-- Agrega más opciones según los métodos de pago aceptados -->
    </select>

    <table>
        <tr>
            <th>Nombre del Producto</th>
            <th>Precio del Producto</th>
            <th>Cantidad del Producto</th>
            <th>Sucursal de Compra</th>
        </tr>
        <?php
        foreach ($productosCarrito as $producto) {
            echo '<tr>';
            echo '<td>' . $producto['pr_nombre'] . '</td>';
            echo '<td>$' . $producto['pr_precioCompra'] . '</td>';
            echo '<td>' . $producto['c_quantity'] . '</td>';
            echo '<td>' . $producto['id_sucursal'] . '</td>';
            echo '</tr>';
        }
        ?>
    </table>

    <?php
    foreach ($productosCarrito as $producto) {
        echo '<input type="hidden" name="productosCarrito[]" value="' . htmlspecialchars(json_encode($producto)) . '">';
    }
    ?>

    <input type="submit" value="Generar Factura">
    <a href="carrito.php">Regresar al Carrito</a>
</form>

</body>
</html>