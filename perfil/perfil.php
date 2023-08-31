<!DOCTYPE html>
<html>
<head>
  <title>Happy Nakda | Perfil</title>
  <link rel="stylesheet" type="text/css" href="../perfil/css/st">
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
                <img class="logo-perfil" src="img/perfillogo.png" alt="">
            </div>
        </a>


        <a class="carrito-index" href="../carrito/carrito.php">
            <div class="carrito-contenedor">
                <img class="logo-carrito" src="img/carritologo.png" alt="">
            </div>
        </a>

        <a class="login-index" href="../login/InSesion.php">
            <div class="login-contenedor">
                <img class="logo-login" src="img/logologin.png" alt="">
            </div>
        </a>

    </header>


    <div class="contenedor-navegacion">
        <nav class="nav-principal container" >
			<a href="../catalogo/catalogo.php">DESCUBRIR</a>
            <a href="../catalogo/catalogo.php">TIENDA</a>
            <a href="../nosotros/nosotros.php">NOSOTROS</a>
            <a href= "../historia/historia.php ">HISTORIA</a>
            
            <div class="dropdown">
            <button class="dropbtn">ADMIN</button>
            <div class="dropdown-content">
            <a href="../administrador/gestiones/gesProduc.html"><img src="../administrador/img/productos.png" alt="Gestion Productos"></a>
            <a href="../administrador/gestiones/gesEmple.html"><img src="../administrador/img/empleado.png" alt="Gestion Empleados"></a>
            <a href="../administrador/gestiones/gesUsu.html"><img src="../administrador/img/cliente.png" alt=""></a>
            </div>
        </div>
        </nav>
    </div>

	<div class="banner-envio">
		<p> Envio rapido y gratuito</p>
		<img class="banner-logo-envio" src="img/envio.png" alt="">
	</div>

  <main>
    <!-- Sección datos perfil -->
    <header class="profile-bar">
      <section class="profile">
        <div class="profile-details">
          <!-- Foto de perfil -->
          <div class="outer-circle">
            <div class="inner-circle">
              <img class="borde-foto" src="img/perfil2.jpeg" alt="Imagen de perfil">
            </div>
          </div>
          <h2 class="nombre-cliente">Hernan Serrano</h2>
          <p class="texto-perfil">hernanxs98@gmail.com</p>
        </div>
      </section>
    </header>

    <div class="cuerpo-bar">
      <div class="button-container">
        <button class="button button-large0 icn-datos">
          <span class="button-icon"><i class="fas fa-datos"></i></span>
          <span class="button-text1">Mis Datos</span>
          <p class="text-inferior1">Valida tus datos</p>
        </button>
        <button class="button button-large1 icn-seguridad">
          <span class="button-icon"><i class="fas fa-seguridad"></i></span>
          <span class="button-text2">Seguridad</span>
          <p class="text-inferior2">Tienes configuraciones pendientes</p>
        </button>
        <button class="button button-large1 icn-tarjetas">
          <span class="button-icon"><i class="fas fa-tarjetas"></i></span>
          <span class="button-text3">Tarjetas</span>
          <p class="text-inferior3">Tarjetas guardadas en tu cuenta</p>
        </button>
        <button class="button button-large1 icn-direcciones">
          <span class="button-icon"><i class="fas fa-direcciones"></i></span>
          <span class="button-text4">Direcciones</span>
          <p class="text-inferior4">Direcciones Guardadas en tu cuenta</p>
        </button>
      </div>
    </div>
    
    
  </main>
  
  <!--FOOTER-->
  <footer class="site-footer">
    <div class="grid-footer container">
        <div>
            <h3 class="txt-footer">Categorias.</h3>
            <nav class="footer-menu">
                <a href="#">Earbuds</a>
                <a href="#">Headsets</a>
                <a href="#">Profesionales</a>
            </nav>
        </div>
        <div>
            <h3 class="txt-footer2">Sobre nosotros.</h3>
            <nav class="footer-menu">
                <a href="#">Nuestra historia.</a>
                <a href="#">Nuestro equipo</a>
                <a href="#">Contacto</a>
            </nav>
        </div>
        <div>
            <h3 class="txt-footer3">Nakda</h3>
            <nav class="footer-menu">
                <a href="#">Descubrir</a>
                <a href="#">Catalogo</a>
                <a href="#">Soporte</a>
            </nav>
        </div>
    </div>
    <p class="copyright">Todos los derechos reservados. Nakda.</p>
  </footer>
</body>
</html>
