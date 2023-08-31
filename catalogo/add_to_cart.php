<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_user'])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión o a otra página
    header('Location: ../login/login.php');
    exit();
}

// Obtener los datos del producto a agregar desde la solicitud POST
if (isset($_POST['product_id']) && isset($_POST['c_quantity']) && isset($_POST['id_sucursal'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['c_quantity'];
    $user_id = $_SESSION['id_user'];
    $id_sucursal = $_POST['id_sucursal']; // Agregamos el ID de la sucursal

    // Crear la conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '12345', 'happynakda');

    // Verificar la conexión
    if (!$conn) {
        die('Error de conexión a la base de datos: ' . mysqli_connect_error());
    }
    $inventario_query = "SELECT in_cantidad FROM tinventarios WHERE id_producto = '$product_id' AND id_sucursal = '$id_sucursal'";
    $inventario_result = mysqli_query($conn, $inventario_query);

    if ($inventario_result && mysqli_num_rows($inventario_result) > 0) {
        $inventario_data = mysqli_fetch_assoc($inventario_result);
        $inventario_disponible = $inventario_data['in_cantidad'];

        if ($quantity > $inventario_disponible) {
            echo '<script>alert("La cantidad deseada excede la cantidad disponible en inventario."); window.history.back();</script>';
            exit(); // No se agrega el producto al carrito
        }
    }

    // Insertar el producto en la tabla "tcarritos" junto con el ID de la sucursal
    $insert_query = "INSERT INTO tcarritos (id_user, id_producto, id_sucursal, c_quantity, c_created_at) 
                     VALUES ('$user_id', '$product_id', '$id_sucursal', '$quantity', NOW())";

    if (mysqli_query($conn, $insert_query)) {
        $message = '¡Producto agregado al carrito!';
    } else {
        $message = 'Error al agregar el producto al carrito: ' . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    $message = 'Error: No se proporcionaron los datos del producto.';
}

// Redireccionar al catálogo o mostrar un mensaje de éxito
if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    echo $message;
}
?>