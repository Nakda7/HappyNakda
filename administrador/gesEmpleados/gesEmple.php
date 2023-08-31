<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_user'])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión o a otra página
    header('Location: ../../login/InSesion.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Gestión de Empleados</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

  
  <h1>Gestión de Empleados</h1>

  <!-- Formulario para crear un usuario -->
  <h2>Agregar Empleados</h2>
  <form action="nuevo.php" method="POST" class="campos">
    <label for="nombre">Nombre:</label>
    <input type="text" name="us_nombre" required><br>

    <label for="correo">Correo:</label>
    <input type="email" name="us_correo" required><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="us_telefono" required><br>

    <label for="contraseña">Contraseña:</label>
    <input type="password" name="us_contraseña" required><br>

    <label for="tipoCliente">Tipo :</label>
    <input type="text" name="id_tipoCliente" required><br>

    <label for="curp">CURP:</label>
    <input type="text" name="us_curp" required><br>

    <input type="submit" value="Crear usuario">
  </form>

  <!-- Formulario para buscar usuarios por nombre -->
  <h2>Filtrar Empleados</h2>
  <div class="form-container">
        <form action="buscar.php" method="GET">
            <label for="nombre_buscar">Buscar por Nombre:</label>
            <input type="text" name="nombre_buscar" required>
            <input type="submit" value="Buscar">
            
        </form>
    </div>

    <h2>Generar Reporte</h2>
    <!-- Formulario para generar el reporte en PDF -->
    <form action="reporte.php" method="POST">
        <input type="submit" value="Generar Reporte PDF">
    </form>




</body>

</html>
