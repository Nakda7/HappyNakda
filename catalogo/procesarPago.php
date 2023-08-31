<!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pago y Facturación</title>
        <link rel="stylesheet" href="./css/Estilos.css">
    </head>

    <body>
        <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <?php
            session_start();

            if (isset($_GET['total'])) {
                $total = $_GET['total'];

                // Conexión a la base de datos
                $conn = mysqli_connect('localhost', 'root', '12345', 'happynakda');

                if (!$conn) {
                    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
                }

                // Obtener el carrito actual del usuario
                $id_user = $_SESSION['id_user'];
                $select_query = "SELECT * FROM tcarritos WHERE id_user = $id_user";
                $result = mysqli_query($conn, $select_query);

                if ($result) {
                    $insufficientInventory = false;
                    $totalToSubtract = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id_producto = $row['id_producto'];
                        $c_quantity = $row['c_quantity'];
                        $id_sucursal = $row['id_sucursal'];

                        // Verificar el inventario disponible
                        $inventory_query = "SELECT in_cantidad FROM tinventarios WHERE id_producto = $id_producto AND id_sucursal = $id_sucursal";
                        $inventory_result = mysqli_query($conn, $inventory_query);

                        if ($inventory_result) {
                            $inventory_data = mysqli_fetch_assoc($inventory_result);
                            $available_quantity = $inventory_data['in_cantidad'];

                            $totalAddedToCart = 0;
                            mysqli_data_seek($result, 0);

                            // Calcular la cantidad total en el carrito para este producto
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['id_producto'] == $id_producto) {
                                    $totalAddedToCart += $row['c_quantity'];
                                }
                            }

                            if (($totalAddedToCart + $totalToSubtract) > $available_quantity) {
                                $insufficientInventory = true;
                                break;
                            } else {
                                $totalToSubtract += $c_quantity;
                            }
                        } else {
                            echo 'Error al obtener el inventario: ' . mysqli_error($conn);
                        }
                    }

                    if (!$insufficientInventory && $totalToSubtract > 0) {
                        // Restar la cantidad del carrito del inventario
                        mysqli_data_seek($result, 0);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $id_producto = $row['id_producto'];
                            $c_quantity = $row['c_quantity'];
                            $id_sucursal = $row['id_sucursal'];

                            // Actualizar la cantidad en el inventario
                            $update_query = "UPDATE tinventarios SET in_cantidad = in_cantidad - $c_quantity WHERE id_producto = $id_producto AND id_sucursal = $id_sucursal";
                            mysqli_query($conn, $update_query);
                            $insert_query = "INSERT INTO tventas (ve_datetime, id_sucursal, id_user, ve_cantidad, t_precio, id_producto) VALUES (NOW(), $id_sucursal, $id_user, '$c_quantity', '$total', $id_producto)";
                        mysqli_query($conn, $insert_query);
                        }

                        echo '<div style="text-align: center; padding: 30px 0; color: #4caf50;">';
                        echo '<div style="font-size: 48px; margin-bottom: 10px;">✔</div>';
                        echo '<h2>Pago exitoso</h2>';
                        echo '<p>¡Gracias por su compra!</p>';
                        echo '</div>';

                        echo '<form method="post" action="">
                                <input type="hidden" name="total" value="<?php echo $total; ?>">
                                <label style="display: block; margin-bottom: 10px;" for="generar_factura">Generar factura:</label>
                                <input style="margin-right: 10px;" type="checkbox" id="generar_factura" name="generar_factura" value="1">
                                <a style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; transition: background-color 0.3s ease-in-out;" href="formularioFac.php">Generar Factura</a>
                            </form>';
                            echo '¡Pago procesado exitosamente!';
                    } else {
                        echo '<p>Inventario insuficiente. Por favor, revise su carrito.</p>';
                        echo '<a href="carrito.php">MODIFICAR CARRITO</a>';
                    }
                } else {
                    echo '<div style="text-align: center; padding: 30px 0; color: #f44336;">';
                    echo '<p>Error al obtener el carrito: ' . mysqli_error($conn) . '</p>';
                    echo '</div>';
                }

                mysqli_close($conn);
               
            } else {
                echo 'Error: No se proporcionó el total del carrito.';
            }
            ?>

           

    </body>

    </html>