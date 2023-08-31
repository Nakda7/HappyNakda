<?php
session_start();
include '../conexion/conexion.php'; // Asegúrate de incluir el archivo que contiene la conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_user'])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión o a otra página
    header('Location: ../login/InSesion.php');
    exit();
}

// Obtener el ID del usuario en sesión
$id_user = $_SESSION['id_user'];

// Consulta para obtener la información del usuario
$select_query = "SELECT * FROM tusers WHERE id_user = $id_user";
$result = mysqli_query($conexion, $select_query);

if (mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
} else {
    // Si no se encontró información del usuario, puedes mostrar un mensaje de error o redirigir a otra página.
    echo 'Error: No se encontró información del usuario.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Nakda!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="../empleado/css/normalize.css">
    <link rel="stylesheet" href="../empleado/css/styles.css">

</head>

<body>

    <!--Header y Navegacion.-->

    	
	<header>
        
        <a class="menu-index" href="Perfil/Perfil/perfil.html">
            <div class="menu-contenedor">
                <img class="logo-menu" src="img/menu.png" alt="">
            </div>
        </a>

        


        <a class="header-a" href="../index/index.php">
        <div class="logo-container"><img class="happy-logo" src="./img/happylogo.png" alt="">
        </div>
        <div class="nombre-sitio-container">
            <h1 class="nombre-sitio"> <span class="nombre-happy">HAPPY </span> <span class="nombre-nakda">NAKDA!</span></h1>
        </div>
        </a>
        
        <a class="perfil-index" href="../perfil/perfil.php">
            <div class="perfil-contenedor">
                <img class="logo-perfil" src="../login/img/perfillogo.png" alt="">
            </div>
        </a>


        <a class="carrito-index" href="../catalogo/carrito.php">
            <div class="carrito-contenedor">
                <img class="logo-carrito" src="../login/img/carritologo.png" alt="">
            </div>
        </a>

        <a class="login-index" href="../cerrar sesion/cerrar_sesion.php">
            <div class="login-contenedor">
                <img class="logo-login" src="../login/img/logologin.png" alt="">
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
            
            <div class="dropdown">
            <button class="dropbtn">ADMIN</button>
            <div class="dropdown-content">
            <a href="../administrador/gesProductos/gesProduc.php"><img src="../administrador/img/productos.png" alt="Gestion Empleados"></a>
            <a href="../administrador/gesUsuarios/gesUsu.php"><img src="../administrador/img/cliente.png" alt=""></a>
            </div>

            
        </nav>
    </div>

	<div class="banner-envio">
		<p> Envio rapido y gratuito</p>
		<img class="banner-logo-envio" src="img/envio.png" alt="">
	</div>

    <div class="perfil-container">
        <div class="perfil-header">
            <h1>Mi Perfil</h1>
            <img src="../catalogo/img/perfil.jpg" alt="Foto de perfil">
        </div>
        <div class="perfil-info">
            <h2>Datos personales</h2>
            <ul class="datos-list">
                <li><span>Nombre:</span> <?php echo $user_data['us_nombre']; ?></li>
                <li><span>Correo electrónico:</span> <?php echo $user_data['us_correo']; ?></li>
                <li><span>Teléfono:</span> <?php echo $user_data['us_telefono']; ?></li>
                <li><span>Fecha de Nacimiento:</span> <?php echo $user_data['us_birthday']; ?></li>
                <!-- Agrega aquí los campos adicionales que desees mostrar -->
            </ul>
        </div>

    <!-- Aquí puedes agregar más contenido de la página, como el historial de compras, etc. -->

</body>
</html>
