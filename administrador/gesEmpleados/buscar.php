<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
    <link rel="stylesheet" href="buscar.css">
</head>
<body>
    
    <h1>Resultados de Búsqueda</h1>

    <?php

    // Verificar si se recibió el nombre a buscar
    if (isset($_GET['nombre_buscar'])) {
        $nombre_buscar = $_GET['nombre_buscar'];

        // Realizar la conexión a la base de datos
        include 'conexion.php';
        $conexion = conectarBD();

        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Construir la consulta SQL con el filtro del nombre buscado
        $query = "SELECT * FROM tusers WHERE id_tipoCliente = 3 AND us_nombre LIKE '%$nombre_buscar%'";

        $result = mysqli_query($conexion, $query);

        // Mostrar los resultados de la búsqueda
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Nombre</th>';
            echo '<th>Email</th>';
            echo '<th>Editar</th>';
            echo '<th>Eliminar</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Procesar y mostrar los resultados
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id_user'] . '</td>';
                echo '<td>' . $row['us_nombre'] . '</td>';
                echo '<td>' . $row['us_correo'] . '</td>';
                echo '<td><a href="actualizar.php?id_user=' . $row['id_user'] . '" class="edit-button">Editar</a></td>';
                echo '<td><a href="eliminar.php?id_user=' . $row['id_user'] . '" class="delete-button" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este usuario?\')">Eliminar</a></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No se encontraron empleados con el nombre '$nombre_buscar'.";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "No se proporcionó ningún nombre para buscar.";
    }
    ?>

</body>
</html>
