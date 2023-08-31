<?php
session_start();
include '../conexion/conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_user'])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión o a otra página
    header('Location: ../login/InSesion.php');
    exit();
}

// Obtener el ID del usuario en sesión
$user_id = $_SESSION['id_user'];

// Obtener el ID de la sucursal (puedes cambiar "1" por el ID de la sucursal que desees mostrar)
$id_sucursal = 1;

// Consulta para obtener el nombre de la sucursal
$select_sucursal = mysqli_query($conexion, "SELECT su_nombre FROM tsucursales WHERE id_sucursal = '$id_sucursal'");
$sucursal_data = mysqli_fetch_assoc($select_sucursal);
$sucursal_nombre = $sucursal_data['su_nombre'];

// Consulta para obtener los productos del inventario de la sucursal
$select_inventario = mysqli_query($conexion, "SELECT tproductos.* FROM tproductos 
    INNER JOIN tinventarios ON tproductos.id_producto = tinventarios.id_producto 
    WHERE tinventarios.id_sucursal = '$id_sucursal'");

// Crear un arreglo para almacenar los IDs de los productos en el carrito
$cart_items = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda | Happy Nakda!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="../catalogo/css/normalize.css">
    <link rel="stylesheet" href="../catalogo/css/styles.css">
</head>
<body class="catalogo-body">
<header>
        
        <a class="menu-index" href="/Perfil/Perfil/perfil.html">
            <div class="menu-contenedor">
                <img class="logo-menu" src="../catalogo/img/menu.png" alt="">
            </div>
        </a>

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
		<img class="banner-logo-envio" src="img/envio.png" alt="">
	</div>
    
    <h1 class="catalogo-tittle">Catalogo de la <?php echo $sucursal_nombre; ?></h1>
    
    <div class="main-content">
        <div class="catalogo-container">
            <nav class="nav-catalogo"><a href="https://skullcandy.mx">Home</a>&nbsp;/&nbsp;Tienda</nav>
            <nav class="catalogo-categorias">
                <a href="https://www.facebook.com/weddleosweiler" class="btn btn-4" target="_blank">EARBUDS
                        <span></span>
                        <span></span> 
                </a>
                <a href="https://www.facebook.com/weddleosweiler" class="btn btn-4" target="_blank">HEADPHONES
                        <span></span>
                        <span></span> 
                </a>
                <a href="https://www.facebook.com/weddleosweiler" class="btn btn-4" target="_blank">WIRELESS
                        <span></span>
                        <span></span> 
                </a>
                <a href="https://www.facebook.com/weddleosweiler" class="btn btn-4" target="_blank">GAMING
                        <span></span>
                        <span></span> 
                </a>
                <a href="https://www.facebook.com/weddleosweiler" class="btn btn-4" target="_blank">PROFESSIONAL
                        <span></span>
                        <span></span> 
                </a>
            </nav>
            <div class="catalogo-banner">
                <p> SOPORTE GRATUITO </p>
            </div>
    <main class="catalogo-section"> 
                <ul class="container-productos">
                    <?php while ($fetch_product = mysqli_fetch_assoc($select_inventario)) { ?>
                    <li class="catalogo-producto">
                        <div class="img-container">
                            <img src="img/<?php echo $fetch_product['pr_image']; ?>" alt="">
                        </div>
                        <p><?php echo $fetch_product['pr_nombre']; ?></p>
                        <p class="price">$<?php echo $fetch_product['pr_precioCompra']; ?></p>

                        <form method="post" action="add_to_cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id_producto']; ?>">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                            <input type="hidden" name="id_sucursal" value="<?php echo $id_sucursal; ?>">
                            
                            <label class="cantidad-label" for="quantity">Cantidad:</label>
                            <input class="cantidad" type="number" name="c_quantity" value="1" min="1" >
                            <input class="card-submit" type="submit" value="Agregar al carrito">
                            <a class="card-detalle" class="ver-detalle" href="producto.php?id_producto=<?php echo $fetch_product['id_producto']; ?>&sucursal=<?php echo $id_sucursal; ?>">Ver Detalle</a>
                        </form>
                    </li>
                    <?php } ?>
                </ul>
            </main>
        </div>
    </div>
</body>
</html>
