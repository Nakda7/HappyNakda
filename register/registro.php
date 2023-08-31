<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registro.css">
    <title>Document</title>
</head>

<body>


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

        <a class="login-index" href="omar/Nakda!/InSesion.php">
            <div class="login-contenedor">
                <img class="logo-login" src="img/logologin.png" alt="">
            </div>
        </a>

    </header>


    <div class="contenedor-navegacion">
        <nav class="nav-principal container" >
			<a href="omar/Nakda!/compra.html">DESCUBRIR</a>
            <a href="omar/Nakda!/compra.html">TIENDA</a>
            <a href="/Nosotros/Nosotros/nosotros.html">NOSOTROS</a>
            <a href="/omar/Nakda!/InSesion.html ">HISTORIA</a>
        </nav>
    </div>

    
	<div class="banner-envio">
		<p> Envio rapido y gratuito</p>
		<img class="banner-logo-envio" src="../register/img/envio.png" alt="">
	</div>

            <form class="register formulario__login" action="register.php" method="POST">
                <h4>Registro</h4>
                <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre" required>
                <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su correo" required>
                <input class="controls" type="text" name="telefono" id="telefono" placeholder="Ingrese su telefono" required>
                <input class="controls" type="text" name="curp" id="curp" placeholder="Ingrese su curp" required>
                <input class="controls" type="password" name="contraseña" id="contraseña" placeholder="Ingrese su contraseña" required>
                <p>Estoy de acuerdo <a href="#">Terminos y condiciones </a></p>
                <input class="botons" type="submit" value="Registrar">
                <p><a href="../login/InSesion.php">¿Ya tienes cuenta?</a></p>
            </form>
    
</body>

</html>