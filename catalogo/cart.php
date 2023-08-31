<?php
session_start();

// Crear la conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '12345', 'happynakda');

// Verificar la conexión
if (!$conn) {
    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
}

// Obtener los productos del carrito desde la tabla "tcarritos"
$id_user = $_SESSION['id_user']; // Obtener el ID de usuario de la sesión
$select_query = "SELECT tproductos.* FROM tcarritos INNER JOIN tproductos ON tcarritos.id_producto = tproductos.id_producto WHERE tcarritos.id_user = $id_user";
$result = mysqli_query($conn, $select_query);

if ($result && mysqli_num_rows($result) > 0) {
    // Mostrar los productos del carrito
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<p>' . $row['pr_nombre'] . ' - Cantidad: ' . $row['c_quantity'] . '</p>';
    }

    // Calcular el total del carrito
    $total_query = "SELECT SUM(tproductos.pr_precioCompra * tcarritos.c_quantity) AS total FROM tcarritos INNER JOIN tproductos ON tcarritos.id_producto = tproductos.id_producto WHERE tcarritos.id_user = $id_user";
    $total_result = mysqli_query($conn, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total = $total_row['total'];

    echo '<p>Total: $' . $total . '</p>';
} else {
    echo '<p>No hay productos en el carrito.</p>';
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
