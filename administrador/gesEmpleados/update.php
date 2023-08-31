<?php
include 'conexion.php';

// Establecer la conexión a la base de datos
$conexion = conectarBD();

// Verificar si la conexión se estableció correctamente
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se enviaron los datos de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de actualización
    $id_user = $_POST["id_user"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $contrasena = $_POST["contrasena"];
    $tipo = $_POST["tipo"];
    $curp = $_POST["curp"];

    // Escapar correctamente los valores de actualización
    $id_user = mysqli_real_escape_string($conexion, $id_user);
    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $correo = mysqli_real_escape_string($conexion, $correo);
    $telefono = mysqli_real_escape_string($conexion, $telefono);
    $contrasena = mysqli_real_escape_string($conexion, $contrasena);
    $tipo = mysqli_real_escape_string($conexion, $tipo);
    $curp = mysqli_real_escape_string($conexion, $curp);

    // Query de actualización
    $query = "UPDATE tusers SET us_nombre = '$nombre', us_correo = '$correo', us_telefono = '$telefono', us_contraseña = '$contrasena', id_tipoCliente = '$tipo', us_curp = '$curp' WHERE id_user = $id_user";

    // Ejecutar la consulta de actualización
    if ($conexion->query($query) === TRUE) {
        echo "Usuario actualizado correctamente.";
        header("Location: gesEmple.php"); // Redireccionar al archivo gesEmple.php
    } else {
        echo "Error al actualizar el usuario: " . $conexion->error;
    }
} else {
    echo "Error: Método de solicitud incorrecto.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
