<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
    <h1>Actualizar Usuario</h1>

    <?php
    include 'conexion.php';

    // Establecer la conexión a la base de datos
    $conexion = conectarBD();

    // Verificar si la conexión se estableció correctamente
    if (!$conexion) {
      die("Error de conexión: " . mysqli_connect_error());
    }

    // Verificar si se proporcionó el parámetro 'id_user'
    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];

        // Escapar correctamente el valor del ID del usuario
        $id_user = mysqli_real_escape_string($conexion, $id_user);

        // Verificar si se enviaron los datos de actualización
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario de actualización
            $nombre = isset($_POST["us_nombre"]) ? $_POST["us_nombre"] : '';
            $correo = isset($_POST["us_correo"]) ? $_POST["us_correo"] : '';
            $telefono = isset($_POST["us_telefono"]) ? $_POST["us_telefono"] : '';
            $contraseña = isset($_POST["us_contraseña"]) ? $_POST["us_contraseña"] : '';
            $tipoCliente = isset($_POST["id_tipoCliente"]) ? $_POST["id_tipoCliente"] : '';
            $curp = isset($_POST["us_curp"]) ? $_POST["us_curp"] : '';

            // Validar los datos aquí si es necesario

            // Actualizar el usuario en la base de datos
            $query = "UPDATE tusers SET us_nombre = ?, us_correo = ?, us_telefono = ?, us_contraseña = ?, id_tipoCliente = ?, us_curp = ? WHERE id_user = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("ssssssi", $nombre, $correo, $telefono, $contraseña, $tipoCliente, $curp, $id_user);
            if ($stmt->execute()) {
                echo "Usuario actualizado correctamente.";
            } else {
                echo "Error al actualizar el usuario: " . $stmt->error;
            }

            // Cerrar la sentencia
            $stmt->close();
        }

        // Obtener los datos actuales del usuario
        $query = "SELECT * FROM tusers WHERE id_user = $id_user";
        $result = $conexion->query($query);

        // Verificar si se obtuvieron los datos del usuario exitosamente
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Aquí puedes utilizar los datos del usuario para cargar los campos de actualización en tu formulario
            $nombre = $row['us_nombre'];
            $correo = $row['us_correo'];
            $telefono = $row['us_telefono'];
            $contraseña = $row['us_contraseña'];
            $tipoCliente = $row['id_tipoCliente'];
            $curp = $row['us_curp'];

            // Mostrar el formulario de actualización con los datos del usuario cargados
            echo '
                <form action="update.php?id_user=' . $id_user . '" method="POST">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="us_nombre" value="' . $nombre . '" required><br>
                    <label for="correo">Correo:</label>
                    <input type="email" name="us_correo" value="' . $correo . '" required><br>
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="us_telefono" value="' . $telefono . '" required><br>
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" name="us_contraseña" value="' . $contraseña . '" required><br>
                    <label for="tipoCliente">Tipo de Cliente:</label>
                    <input type="text" name="id_tipoCliente" value="' . $tipoCliente . '" required><br>
                    <label for="curp">CURP:</label>
                    <input type="text" name="us_curp" value="' . $curp . '" required><br>
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
    mysqli_close($conexion);
    ?>
</body>
</html>
