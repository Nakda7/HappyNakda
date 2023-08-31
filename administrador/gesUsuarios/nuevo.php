<?php
include 'conexion.php';

// Obtener los datos del formulario
$nombre = $_POST['us_nombre'];
$correo = $_POST['us_correo'];
$telefono = $_POST['us_telefono'];
$contraseña = $_POST['us_contraseña'];
$tipoCliente = $_POST['id_tipoCliente'];
$curp = $_POST['us_curp'];

$conn = conectarBD();

// Consulta de inserción
$sql = "INSERT INTO tusers (us_nombre, us_correo, us_telefono, us_contraseña, id_tipoCliente, us_curp) 
        VALUES ('$nombre', '$correo', '$telefono', '$contraseña', '$tipoCliente', '$curp')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario creado exitosamente";
    header("Location: gesUsu.php");
} else {
    echo "Error al crear el usuario: " . $conn->error;
}

$conn->close();
?>
