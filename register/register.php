<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "happynakda"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Procesar los datos del formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"]; 
    $telefono = $_POST["telefono"];
    $curp = $_POST["curp"];
    $contraseña = $_POST["contraseña"];
    
    
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO tusers (us_nombre, us_correo, us_telefono, us_contraseña, us_curp ) VALUES ( '$nombre', '$correo', '$telefono', '$contraseña', '$curp' )";

    if ($conn->query($sql) === TRUE) {
        echo "Los datos se han guardado correctamente.";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }
}

$conn->close();
?>