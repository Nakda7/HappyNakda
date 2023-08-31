<?php
include 'conexion.php';

// Establecer la conexión a la base de datos
$conexion = conectarBD();

// Verificar si la conexión se estableció correctamente
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se realizó una búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $termino_busqueda = isset($_POST["termino_busqueda"]) ? $_POST["termino_busqueda"] : '';
    $precio_min = isset($_POST["precio_min"]) ? $_POST["precio_min"] : '';
    $precio_max = isset($_POST["precio_max"]) ? $_POST["precio_max"] : '';
    $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : '';

    // Query para buscar productos que coincidan con los términos de búsqueda
    $query = "SELECT * FROM tproductos WHERE pr_nombre LIKE ? AND pr_precioCompra BETWEEN ? AND ?";

    // Agrega la condición para la categoría si se seleccionó
    if ($categoria != '') {
        $query .= " AND pr_gama = ?";
    }

    
    // Preparar la consulta
    $stmt = $conexion->prepare($query);

    if ($stmt) { // Verificar que la consulta se preparó correctamente
        // Bind de los parámetros
        $termino_busqueda = "%" . $termino_busqueda . "%";
        $stmt->bind_param("sdds", $termino_busqueda, $precio_min, $precio_max, $categoria);

        // Ejecutar la consulta
        if ($stmt->execute()) { // Verificar que la consulta se ejecutó correctamente
            // Obtener los resultados
            $result = $stmt->get_result();

            // Verificar si se encontraron registros
            if ($result && $result->num_rows > 0) {

                echo '<link rel="stylesheet" type="text/css" href="estilos.css">';
                // Resto del código para mostrar los productos en una tabla
                echo '<table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio de Compra</th>
                                <th>Marca</th>
                                <th>Color</th>
                                <th>Gama</th>
                            </tr>
                        </thead>
                        <tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                            <td>' . $row['id_producto'] . '</td>
                            <td>' . $row['pr_nombre'] . '</td>
                            <td>' . $row['pr_descripcion'] . '</td>
                            <td>' . $row['pr_precioCompra'] . '</td>
                            <td>' . $row['pr_marca'] . '</td>
                            <td>' . $row['pr_color'] . '</td>
                            <td>' . $row['pr_gama'] . '</td>
                            <td><a href="editar.php?id_producto=' . $row['id_producto'] . '">Editar</a></td>
                            <td><a href="eliminar.php?id_producto=' . $row['id_producto'] . '">Eliminar</a></td>
            <td><a href="alta.php?id_producto=' . $row['id_producto'] . '">Alta</a></td>
                            
                        </tr>';
                }

                echo '</tbody></table>';
            } else {
                echo "No se encontraron productos.";
            }
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }

    // Cerrar el statement
    $stmt->close();
} else {
    // Si no se realizó una búsqueda, puedes mostrar todos los productos o un formulario de búsqueda vacío
    // ...
}



?>
