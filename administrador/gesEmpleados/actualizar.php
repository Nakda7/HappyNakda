<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Usuario</title>
</head>
<body>
    <h1>Actualizar Usuario</h1>

    <?php
    include 'conexion.php';

    // Establecer la conexión a la base de datos
    $conexion = conectarBD();

    // Verificar si la conexión se estableció correctamente
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verificar si se proporcionó el parámetro 'id_user'
    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];

        // Escapar correctamente el valor del ID del usuario
        $id_user = mysqli_real_escape_string($conexion, $id_user);

        // Ejecutar una consulta para obtener los datos existentes del usuario
        $query = "SELECT * FROM tusers WHERE id_user = $id_user";
        $result = $conexion->query($query);

        // Verificar si se obtuvieron los datos del usuario exitosamente
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Aquí puedes utilizar los datos del usuario para cargar los campos de actualización en tu formulario
            $nombre = $row['us_nombre'];
            $correo = $row['us_correo'];
            $telefono = $row['us_telefono'];
            $contrasena = $row['us_contraseña'];
            $tipo = $row['id_tipoCliente'];
            $curp = $row['us_curp'];

            // Mostrar el formulario de actualización con los datos del usuario cargados
            echo '
                <form action="update.php" method="POST" onsubmit="return mostrarAlerta();">
                    <input type="hidden" name="id_user" value="' . $id_user . '">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="' . $nombre . '"><br>
                    <label for="correo">Correo:</label>
                    <input type="email" name="correo" value="' . $correo . '"><br>
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" value="' . $telefono . '"><br>
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" value="' . $contrasena . '"><br>
                    <label for="tipo">Tipo:</label>
                    <input type="text" name="tipo" value="' . $tipo . '"><br>
                    <label for="curp">CURP:</label>
                    <input type="text" name="curp" value="' . $curp . '"><br>
                    <input type="submit" value="Actualizar">
                </form>

              
            ';
        } else {
            echo "No se encontró el usuario.";
        }
    } else {
        echo "No se proporcionó el parámetro 'id_user'.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
    ?>
</body>
</html>

