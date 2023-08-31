<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesion</title>
    <link rel="stylesheet" href="../login/estilos.css">




</head>


 <!--Header y Navegacion.-->

    	
 <header>
        
        <a class="menu-index" href="Perfil/Perfil/perfil.html">
            <div class="menu-contenedor">
                <img class="logo-menu" src="img/menu.png" alt="">
            </div>
        </a>

        <a class="header-a" href="../index.php">
        <div class="logo-container"><img class="happy-logo" src="./img/happylogo.png" alt="">
        </div>
        <div class="nombre-sitio-container">
            <h1 class="nombre-sitio"> <span class="nombre-happy">HAPPY </span> <span class="nombre-nakda">NAKDA!</span></h1>
        </div>
        </a>
        
        <a class="perfil-index" href="perfil/perfil.html">
            <div class="perfil-contenedor">
                <img class="logo-perfil" src="img/perfillogo.png" alt="">
            </div>
        </a>


        <a class="carrito-index" href="omar/Nakda!/carrito.php">
            <div class="carrito-contenedor">
                <img class="logo-carrito" src="img/carritologo.png" alt="">
            </div>
        </a>

        <a class="login-index" href="login/InSesion.php">
            <div class="login-contenedor">
                <img class="logo-login" src="img/logologin.png" alt="">
            </div>
        </a>

    </header>


	<div class="banner-envio">
		<p> Envio rapido y gratuito</p>
		<img class="banner-logo-envio" src="img/envio.png" alt="">
	</div>


<body>

    <main class="main-container">
    <div class="texto">

        <h1>Login</h1>
        <form action="./login.php" method="POST" >
            <label for="username">Usuario</label>
            <input type="text" placeholder="Enter correo" name="us_correo">

            <label for="username">Contraseña</label>
            <input type="password" placeholder="Enter contraseña" name="us_contraseña">

            <input type="submit" value="login ">
            <a href="">Olvidaste tu contraseña</a> <br>
            <a href="../register/registro.php">Registrase</a>

        </form>

    </div>

    <div class="hero">
        <img src="/img/bosehero.jpeg" alt="">
    </div>
    </main>

</body>




</html>