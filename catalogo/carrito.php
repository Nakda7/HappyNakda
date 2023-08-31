<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_user'])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión o a otra página
    header('Location: ../login/InSesion.php');
    exit();

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="../catalogo/css/styles.css">
</head>
<body class="carrito">
    <header>
        
        <a class="menu-index" href="/Perfil/Perfil/perfil.html">
            <div class="menu-contenedor">
                <img class="logo-menu" src="../catalogo/img/menu.png" alt="">
            </div>
        </a>zy

        <a class="header-a" href="javascript:void(0);" onclick="goBack()">
             <div class="logo-container"><img class="happy-logo" src="./img/happylogo.png" alt=""></div>
            <div class="nombre-sitio-container">
                <h1 class="nombre-sitio"> <span class="nombre-happy">HAPPY </span> <span class="nombre-nakda">NAKDA!</span></h1>
            </div>
        </a>

        <script>
        function goBack() {
            window.history.back();
        }
        </script>
        
        <a class="perfil-index" href="../perfil/perfil.php">
            <div class="perfil-contenedor">
                <img class="logo-perfil" src="../catalogo/img/perfillogo.png" alt="">
            </div>
        </a>


        <a class="carrito-index" href="../catalogo/carrito.php">
            <div class="carrito-contenedor">
                <img class="logo-carrito" src="../catalogo//img/carritologo.png" alt="">
            </div>
        </a>

        <a class="login-index" href="../cerrar sesion/cerrar_sesion.php">
            <div class="login-contenedor">
                <img class="logo-login" src="../catalogo/img/logologin.png" alt="">
            </div>
        </a>

    </header>

    <div class="contenedor-navegacion">
        <nav class="nav-principal container" >
            
        <div class="dropdown">
            <button class="dropbtn">DESCUBRIR</button>
            <div class="dropdown-content">
            <a href="../catalogo/catalogo1.php"><p>Querétaro</p></a>
            <a href="../catalogo/catalogo2.php"><p>Monterrey</p></a>
            <a href="../catalogo/catalogo3.php"><p>Guadalajara</p></a>
            </div>
        </div>

        <a href="../catalogo/catalogo1.php">TIENDA</a>
        <a href="../nosotros/nosotros.php">NOSOTROS</a>
        <a href= "../historia/historia.php ">HISTORIA</a>
            
        </nav>
    </div>

    <div class="banner-envio">
        <p> Envio rapido y gratuito</p>
        <img class="banner-logo-envio" src="img/envio-global.png" alt="">
    </div>
    
    <h1 class="carrito-head">Tú carrito</h1>

    <?php
    // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '12345', 'happynakda');

    // Verificar la conexión
    if (!$conn) {
        die('Error de conexión a la base de datos: ' . mysqli_connect_error());
    }

    // Obtener el ID de usuario de la sesión
    $id_user = $_SESSION['id_user'];

    //OBTENIENDO EL NOMBRE DEL USUARIO DEL CARRITO PARA MOSTRARLO EN PANTALLA.
    $select_query_name = "SELECT us_nombre FROM tusers WHERE id_user = '$id_user'";
    $result_name = mysqli_query($conn, $select_query_name);

    if ($result_name && mysqli_num_rows($result_name) > 0) {
        $row_name = mysqli_fetch_assoc($result_name);
        $nombre_usuario = $row_name['us_nombre'];
    } else {
        // No se pudo obtener el nombre de usuario, manejar el error
        $nombre_usuario = "Usuario Desconocido";
    }
    

    // Consulta para obtener los productos del carrito y la información del usuario
    $select_query = "SELECT tproductos.*, tusers.us_nombre, tcarritos.c_quantity, tinventarios.id_sucursal FROM tcarritos
        INNER JOIN tproductos ON tcarritos.id_producto = tproductos.id_producto
        INNER JOIN tusers ON tcarritos.id_user = tusers.id_user
        INNER JOIN tinventarios ON tcarritos.id_producto = tinventarios.id_producto
        WHERE tcarritos.id_user = $id_user AND tinventarios.id_sucursal = tcarritos.id_sucursal"; // Agregamos el filtro por la sucursal actual
    $result = mysqli_query($conn, $select_query);

    

    echo '<h3 class="tittle-cart">Hola, '. $nombre_usuario . '</h3>';
    
    if (mysqli_num_rows($result) > 0) {
        echo '<ul class="section-cart">';
        $total = 0; // Inicializar el total
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="cart-grid">';
                echo '<li class="img"><img src="../catalogo/img/' . $row['pr_image'] . '" alt="Imagen del producto"></li>';
                echo '<div class="text">';
                    echo '<li>' . $row['pr_nombre'] . '</li>';
                    echo '<li>$' . $row['pr_precioCompra'] . '</li>';
                    echo '<li>Cantidad: ' . $row['c_quantity'] . '</li>';
                    echo '<li>Sucursal: ' . $row['id_sucursal'] . '</li>';

                    // Calcular el subtotal del producto
                    $subtotal = $row['pr_precioCompra'] * $row['c_quantity'];
                    // Sumar el subtotal al total
                    $total += $subtotal;

                    echo '<form action="eliminarProduc.php" method="POST">';
                        echo '<input type="hidden" name="product_id" value="' . $row['id_producto'] . '">';
                        echo '<input class="boton-carrito" type="submit" name="delete" value="Eliminar">';
                        echo '</form>';
                    echo '</div>';
            echo '</div>';
            echo '<hr class="linea-horizontal">';
        }

        // Mostrar el total de los productos
        echo '<p class="pagar-input">Total: $ ' . $total . '</p>';

    } else {

            echo '<h3 class="tittle-cart-vacio">¡Upsss... El carrito está vacío! </h3>';

    }

        mysqli_close($conn);

    ?>
</body>
</html>

<html>
    <body>
        <script src="https://www.paypal.com/sdk/js?client-id=AVEkyraA4M6-d7zKyMzMe7jzgc3r0AtdiY8gOlEHw8nAYqAmO8cOo5JMMafxuSYrw5SQ3DSSLoc4nFoT&currency=MXN"></script>
        <div id="paypal-button-container"></div>
        <script>

            completado = false;

            paypal.Buttons({
                style: {
                    color: 'blue',
                    shape: 'pill',
                    label: 'pay'
                },
                
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: <?php echo $total; ?> // Total obtenido de PHP
                            }
                }]
            })
        },
        
        onApprove: function (data, actions) {
            actions.order.capture().then(function (details) {
                
                
                
                window.location.href = "procesarPago.php?total=<?php echo $total; ?>&id_user=<?php echo $_SESSION['id_user']; ?>";

            })
        },
        
        onCancel: function (data) {
            alert("Pago Cancelado");
            console.log(data);
        }
         }).render('#paypal-button-container');

        </script>
    </div> 
</body>
</html>