<?php
session_start();
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del producto a eliminar del carrito
    $product_id = $_POST['product_id'];
    $id_user = $_SESSION['id_user'];

    // Obtener la id_sucursal del producto en el carrito
    $sucursal_query = "SELECT id_sucursal FROM tcarritos WHERE id_producto = $product_id AND id_user = $id_user LIMIT 1";
    $sucursal_result = mysqli_query($conexion, $sucursal_query);

    if ($sucursal_result) {
        $sucursal_data = mysqli_fetch_assoc($sucursal_result);
        $id_sucursal = $sucursal_data['id_sucursal'];

        // Realizar la acción de eliminar el producto específico del carrito
        $delete_query = "DELETE FROM tcarritos WHERE id_producto = $product_id AND id_user = $id_user AND id_sucursal = $id_sucursal LIMIT 1";

        // Ejecutar la consulta de eliminación
        if (mysqli_query($conexion, $delete_query)) {
            // El producto se eliminó correctamente
            header('Location: carrito.php');
            exit();
        } else {
            // Error al eliminar el producto
            echo 'Error al eliminar el producto del carrito: ' . mysqli_error($conexion);
        }
    } else {
        // Error al obtener la id_sucursal
        echo 'Error al obtener la id_sucursal del producto: ' . mysqli_error($conexion);
    }
}
?>
