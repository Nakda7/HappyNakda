<?php
// Verificar que la solicitud es por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el total y el ID de la sucursal enviados por la solicitud AJAX
    $total = $_POST["total"];
    $id_sucursal = $_POST["id_sucursal"];

    // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '12345', 'happynakda');

    // Verificar la conexión
    if (!$conn) {
        die('Error de conexión a la base de datos: ' . mysqli_connect_error());
    }

    // Actualizar la cantidad en la tabla tinventarios restando el total del carrito
    $update_query = "UPDATE tinventarios SET in_cantidad = in_cantidad - $total WHERE id_sucursal = $id_sucursal";

    if (mysqli_query($conn, $update_query)) {
        echo 'Inventario actualizado con éxito.';
    } else {
        echo 'Error al actualizar el inventario: ' . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>
