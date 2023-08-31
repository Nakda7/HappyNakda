<?
//Conexión a la base de datos
include '../conexion/conexion.php';

session_start();

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
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">

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
            <a href="../administrador/gesEmpleados/gesEmple.php"><img src="../administrador/img/empleado.png" alt="Gestion Empleados"></a>
            <a href="../administrador/gesUsuarios/gesUsu.php"><img src="../administrador/img/cliente.png" alt=""></a>
            </div>

            
        </nav>
    </div>

	<div class="banner-envio">
		<p> Envio rapido y gratuito</p>
		<img class="banner-logo-envio" src="img/envio.png" alt="">
	</div>

    

    <!-- Hero -->
    <div class="hero">
        <div class="none-hero"></div>
        <div class="texto-hero">
            <h2 class="title-hero">El   sonido   ahora   es   personal.</h2>
            <h3 class="texto-title"> NUEVO | QUIETCOMFORT EARBUDS II</h3>
        </div>
    </div>
    
    <!-- Categorias. -->
    <section class="categorias container">
        
        <h2 class="text-center">CATEGORIAS DE PRODUCTOS</h2>

        <div class="listado-categorias">
            <div class="categoria">
                <img src="img/earbudsBsaka.jpg" alt="">
                <a href="#">Earbuds</a>
            </div>
           
            <div class="categoria">
                <img src="img/komanbeats.jpg" alt="Imagen Categoria.">
                <a href="#">Headphones</a>
            </div>
           
            <div class="categoria">
                <img src="img/gnabrybeats.jpg" alt="Imagen Categoria.">
                <a href="#">Headsets</a>
            </div>
        </div>
    </section>

    <div class="header">
        <div class="contenedor contenido-header">
            

            <div class="texto-header">
                <p class="tagline-producto">Sonido Profesional.</p>
                <h1 class="nombre-producto degradado-rgb">Nakda! Mils</h1>
                <p class="descripcion-producto">¡Presentamos los audífonos gamer Nakda! Mils, la elección perfecta para aquellos que buscan llevar su experiencia de juego al siguiente nivel. Estos audífonos han sido diseñados meticulosamente para brindarte un audio inmersivo y una comodidad excepcional, permitiéndote sumergirte por completo en el mundo virtual.</p>
                <p class="precio-producto">Desde <span>$1299</span> </p>
            </div>

            <div class="imagen-header">
                <picture>
                    <source
                        sizes="1920w" 
                        srcset="img/beatsrojoshero.png 1920w"
                        type="image/png">
                    <source
                        sizes="1920w" 
                        srcset="img/beatsrojoshero.png 1920w" 
                        type="image/png">
                    <source
                        sizes="1920w" 
                        srcset="img/beatsrojoshero.png 1920w" 
                        type="image/png">
                    <img loading="lazy" decoding="async" src="img/beatsrojoshero.png" lazyalt="imagen" width="1000" height="600">
                </picture>
            </div> <!-- .imagen-header -->
        </div>
    </div>

    <section class="contenedor">
        <div class="iconos">
            <div class="icono">
                <img src="img/icono-sonido.svg" alt="imagen icono">
                <h3 class="degradado-rgb">Gran Sonido</h3>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis convallis porttitor sodales. Duis accumsan lorem neque.</p>
            </div>

            <div class="icono">
                <img src="img/icono-garantia.svg" alt="imagen icono">
                <h3 class="degradado-rgb">Garantía de por vida</h3>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis convallis porttitor sodales. Duis accumsan lorem neque.</p>
            </div>

            <div class="icono">
                <img src="img/icono-bateria.svg" alt="imagen icono">
                <h3 class="degradado-rgb">+20 Horas de Bateria</h3>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis convallis porttitor sodales. Duis accumsan lorem neque.</p>
            </div>
        </div>
    </section>

    <div class="hero-2">
        <div class="none-hero"></div>
        <div class="texto-hero">
            <h2 class="title-hero">Icónico silencio. Comodidad. Y sonido.</h2>
            <h3 class="texto-title"> AUDÍFONOS BOSE QUIETCOMFORT® 45 HEADPHONES</h3>
        </div>
    </div>


    <div class="hero-4">
        <div class="none-hero"></div>
        <div class="texto-hero">
            <h2 class="title-hero">Icónico silencio. Comodidad. Y sonido.</h2>
            <h3 class="texto-title"> AUDÍFONOS BOSE QUIETCOMFORT® 45 HEADPHONES</h3>
        </div>
    </div>

    <div class="hero-3">
        <div class="none-hero"></div>
        <div class="texto-hero">
            <h2 class="title-hero">Los mejores en el mercado. Calidad Precio.</h2>
        </div>
    </div>

    <main class="contenedor modelos">
        <h2 class="text-center degradado-negro header-modelos">Elige tus NakdaPRO</h2>

        <div class="listado-modelos">
            <div class="modelo modelo-x">
                <h3>NakdaPRO X</h3>
                <p class="precio">$299</p>
            </div>

            <div class="modelo modelo-y">
                <h3>NakdaPRO Y</h3>
                <p class="precio">$399</p>
            </div>

            <div class="modelo modelo-z">
                <h3>NakdaPRO Z</h3>
                <p class="precio">$499</p>
            </div>

        </div>
    </main>

    <section class="newsletter">
        <div class="contenido-newsletter contenedor">
            <div class="texto-newsletter">
                <h2>Recibe Actualizaciones</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur vitae maxime praesentium assumenda nulla consequatur illo facere ullam, debitis dolore. Aliquid a recusandae nam beatae dolor veniam et, exercitationem placeat?</p>

                <form class="formulario">
                    <div class="input">
                        <input type="text" placeholder="Tu Email" >
                    </div>

                    <input type="submit" value="Inscribirme">
                </form>
            </div>
        </div>
    </section>
    
    <footer class="footer">
        <p>Todos los derechos reservados</p>
    </footer>


    <script src="js/imagenes.js"></script>
</body>
</html>