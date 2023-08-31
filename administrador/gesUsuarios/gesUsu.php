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
  <title>Gestión de Usuarios</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <h1>Gestión de Usuarios</h1>
  <!-- Formulario para crear un usuario -->
  <h2>Agregar Usuario</h2>
  <form action="nuevo.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="us_nombre" required><br>

<label for="correo">Correo:</label>
<input type="email" name="us_correo" required><br>

<label for="telefono">Teléfono:</label>
<input type="text" name="us_telefono" required><br>

<label for="contraseña">Contraseña:</label>
<input type="password" name="us_contraseña" required><br>

<label for="tipoCliente">Tipo de Cliente:</label>
<input type="text" name="id_tipoCliente" required><br>

<label for="curp">CURP:</label>
<input type="text" name="us_curp" required><br>

<input type="submit" value="Crear usuario">
  </form>
  <h2>Generar Reporte</h2>
    <!-- Formulario para generar el reporte en PDF -->
    <form action="reporte.php" method="POST">
        <input type="submit" value="Generar Reporte PDF">
    </form>
  <!-- Tabla de usuarios registrados -->
  <div class="users-table">
    <h2>Usuarios registrados</h2>
    <?php
    include 'conexion.php';

$conexion = conectarBD();

// Verificar si la conexión se estableció correctamente
if (!$conexion) {
  die("Error de conexión: " . mysqli_connect_error());
}

// Ejecutar la consulta
$query = "SELECT * FROM tusers";
$result = mysqli_query($conexion, $query);

// Verificar si se encontraron registros
if ($result && mysqli_num_rows($result) > 0) {
  // Mostrar la tabla de usuarios registrados
?>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Tipo de Cliente</th>
        <th>CURP</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Procesar y mostrar los resultados
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr>
          <td><?= $row['id_user'] ?></td>
          <td><?= $row['us_nombre'] ?></td>
          <td><?= $row['us_correo'] ?></td>
          <td><?= $row['us_telefono'] ?></td>
          <td><?= $row['id_tipoCliente'] ?></td>
          <td><?= $row['us_curp'] ?></td>
          <td>
            <a href="update.php?id_user=<?= $row['id_user'] ?>" class="users-table--edit">Editar</a>
            <a href="eliminar.php?id_user=<?= $row['id_user'] ?>" class="users-table--delete" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
<?php
} else {
  // No se encontraron registros
  echo "<p>No se encontraron usuarios registrados.</p>";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
  </div>
</body>
</html>
