<?php
session_start();
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['us_correo'];
    $password = $_POST['us_contraseña'];

    // Consulta para verificar las credenciales de inicio de sesión
    $query = "SELECT * FROM tusers WHERE us_correo = '$email' AND us_contraseña = '$password'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        
        $user = mysqli_fetch_assoc($result);
        
        $_SESSION['id_user'] = $user['id_user'];

        // Redireccionar al catálogo o a otra página según el tipo de usuario
        if ($user['id_tipoCliente'] === "1" ) {
        
            header("Location: ../administrador/admin.php");
        }
        elseif($user['id_tipoCliente'] === "3"){
            
            header("Location:../empleado/empleado.php");

        }else {

            header("Location: ../index/index.php");
        
        }
    exit();

    } else {
        
        $error_message = 'Credenciales inválidas. Por favor, intenta nuevamente.';
        
        header("Location: ../index/index.php");
        
    }
}
?>

