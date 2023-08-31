<?php
// Establecer la conexión a la base de datos (reemplaza con tus datos de conexión)
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "HappyNakda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Realizar la consulta para obtener los productos de la Sucursal 3
$sql = "SELECT tproductos.*, tinventarios.in_cantidad
        FROM tproductos
        INNER JOIN tinventarios ON tproductos.id_producto = tinventarios.id_producto
        WHERE tinventarios.id_sucursal = 3";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los productos de la Sucursal 3 en forma de tabla
    echo "<h3>Productos de la Sucursal 3:</h3>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Descripción</th><th>Precio de Compra</th><th>Marca</th><th>Color</th><th>Gama</th><th>Cantidad</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["pr_nombre"] . "</td>";
        echo "<td>" . $row["pr_descripcion"] . "</td>";
        echo "<td>" . $row["pr_precioCompra"] . "</td>";
        echo "<td>" . $row["pr_marca"] . "</td>";
        echo "<td>" . $row["pr_color"] . "</td>";
        echo "<td>" . $row["pr_gama"] . "</td>";
        echo "<td>" . $row["in_cantidad"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron productos para la Sucursal 3";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
