<?php
session_start();
include '../conexion/conexion.php';

if (!isset($_SESSION['id_user'])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión o a otra página
    header('Location: ../login/InSesion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_producto'])) {
    $product_id = $_GET['id_producto'];

    // Consulta para obtener los detalles del producto
    $select_product = mysqli_query($conexion, "SELECT tproductos.* FROM tproductos WHERE id_producto = '$product_id'");
    $product_data = mysqli_fetch_assoc($select_product);
} else {
    header('Location: catalogo.php');
    exit();
}

// Obtener el ID de la sucursal desde la URL (por ejemplo, "catalogo1.php" tendría ?sucursal=1)
$id_sucursal = isset($_GET['sucursal']) ? $_GET['sucursal'] : '';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
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

    
    <div class="product-grid">
    <img class="producto-imagen" src="img/<?php echo $product_data['pr_image']; ?>" alt="Imagen del Producto">
    <div class="product-text">
        <h2 class="tittle-producto"><?php echo $product_data['pr_nombre']; ?></h2>
        <h2 class="producto-descripcion" ><?php echo $product_data['pr_descripcion']; ?></h2>
        <p class="product-precio"> $<?php echo $product_data['pr_precioCompra']; ?></p>
            <form class="product-form" method="post" action="add_to_cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product_data['id_producto']; ?>">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                <input type="hidden" name="id_sucursal" value="<?php echo $id_sucursal; ?>">
                <label class="cantidad-label-product" for="c_quantity">Cantidad:</label>
                <input class="cantidad-product" type="number" id="c_quantity" name="c_quantity" value="1" min="1">
                <button class="product-submit" type="submit">Agregar al Carrito</button>
            </form>
            <a class="product-detalle" href="catalogo<?php echo $id_sucursal; ?>.php">Volver al Catálogo</a>
    </div>
    </div>
</body>
</html>
