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
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="gesProduc.css">
</head>

<body>

    <h1>Gestión de Productos</h1>

    <h2>Agregar Producto</h2>
    <form action="nuevo.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="pr_nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" name="pr_descripcion" required><br>

        <label for="precioCompra">Precio de Compra:</label>
        <input type="number" step="0.01" name="pr_precioCompra" required><br>

        <label for="marca">Marca:</label>
        <input type="text" name="pr_marca" required><br>

        <label for="color">Color:</label>
        <input type="text" name="pr_color" required><br>

        <label for="gama">Gama:</label>
        <input type="text" name="pr_gama" required><br>

        <input type="submit" value="Agregar Producto">
    </form>

    <h2>Búsqueda Avanzada</h2>
    <form action="buscar.php" method="POST">
        <label for="termino_busqueda">Término de búsqueda:</label>
        <input type="text" name="termino_busqueda" id="termino_busqueda">

        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria">

            <option value="alta">Alta</option>
            <option value="media">Media</option>
            <option value="baja">Baja</option>
        </select>

        <label for="precio_min">Precio mínimo:</label>
        <input type="number" name="precio_min" id="precio_min" step="0.01">

        <label for="precio_max">Precio máximo:</label>
        <input type="number" name="precio_max" id="precio_max" step="0.01">

        <!-- Agrega más campos de búsqueda avanzada aquí -->

        <input type="submit" value="Buscar">
    </form>


    <h2>Productos registrados</h2>
    <!-- Agregamos los botones para seleccionar la sucursal -->
    <form id="sucursalForm" method="POST">
        <label for="sucursal">Seleccionar Sucursal:</label>
        <select name="sucursal" id="sucursal">
            <option value="1">Sucursal 1</option>
            <option value="2">Sucursal 2</option>
            <option value="3">Sucursal 3</option>
        </select>
        <input type="submit" value="Mostrar Productos">
    </form>


    <h2>Generar Reporte</h2>
    <!-- Formulario para generar el reporte en PDF -->
    <form action="genReporte.php" method="POST">
        <input type="submit" value="Generar Reporte PDF">
    </form>
    <h2>Reporte de Ventas</h2>
    <!-- Formulario para generar el reporte en PDF -->
    <form action="reporte.php" method="POST">
        <input type="submit" value="Generar Reporte PDF">
    </form>

    <script>
        // Script para redirigir el formulario de sucursal a una acción diferente según la opción seleccionada
        document.getElementById("sucursalForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            // Obtener el valor de la opción seleccionada
            var sucursalSeleccionada = document.getElementById("sucursal").value;

            // Establecer el atributo "action" del formulario según la opción seleccionada
            if (sucursalSeleccionada === "1") {
                this.action = "buscarProduc1.php"; // Ruta a mostrar_sucursal1.php
            } else if (sucursalSeleccionada === "2") {
                this.action = "buscarProduc2.php"; // Ruta a mostrar_sucursal2.php
            } else if (sucursalSeleccionada === "3") {
                this.action = "buscarProduc3.php"; // Ruta a mostrar_sucursal3.php
            }

            // Enviar el formulario a la acción correspondiente
            this.submit();
        });
    </script>












</body>

</html>