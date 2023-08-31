<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $telefono = $_POST['telefono'];
    $metodoPago = $_POST['metodoPago'];

    // Validar los datos (realizar las validaciones necesarias)

    // Procesar la generación de la factura
    // ...

    // Cargar la librería FPDF
    require('../fpdf/fpdf.php');

    // Crear una instancia de la clase FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Agregar el contenido de la factura
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 10, 'Factura', 0, 1, 'C');

    // Agregar los datos del cliente en forma de tabla
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'Nombre del Cliente: ' . $nombre, 0, 1);
    $pdf->Cell(0, 10, 'Direccion del Cliente: ' . $direccion, 0, 1);
    $pdf->Cell(0, 10, 'Fecha de Factura: ' . $fecha, 0, 1); // Agregar fecha de factura
    $pdf->Cell(0, 10, 'Numero de Telefono: ' . $telefono, 0, 1); // Agregar número de teléfono
    $pdf->Cell(0, 10, 'Metodo de Pago: ' . $metodoPago, 0, 1); // Agregar método de pago
    $pdf->Ln(); // Salto de línea

    // Crear la tabla para mostrar los productos del carrito
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(110, 10, 'Nombre del Producto', 1);
    $pdf->Cell(25, 10, 'PR', 1);
    $pdf->Cell(15, 10, 'C', 1);
    $pdf->Cell(15, 10, 'S', 1);
    $pdf->Cell(30, 10, 'Total', 1); // Agregar una columna para mostrar el total por producto
    $pdf->Ln(); // Salto de línea

    $pdf->SetFont('Arial', '', 12);

    // Variables para el cálculo del subtotal y total
    $subtotal = 0;
    $iva = 0;
    $totalCompra = 0;

    // Recorrer el array $productosCarrito para mostrar los productos en la tabla
    $productosCarrito = isset($_POST['productosCarrito']) ? $_POST['productosCarrito'] : array();
    foreach ($productosCarrito as $producto) {
        $productoData = json_decode(htmlspecialchars_decode($producto), true);

        $pdf->Cell(110, 10, $productoData['pr_nombre'], 1);
        $pdf->Cell(25, 10, '$' . $productoData['pr_precioCompra'], 1);
        $pdf->Cell(15, 10, $productoData['c_quantity'], 1);
        $pdf->Cell(15, 10, $productoData['id_sucursal'], 1);

        // Calcular el total del producto (precio de compra * cantidad)
        $totalProducto = $productoData['pr_precioCompra'] * $productoData['c_quantity'];
        $pdf->Cell(30, 10, '$' . $totalProducto, 1);
        $pdf->Ln(); // Salto de línea

        // Actualizar el subtotal
        $subtotal += $totalProducto;
    }

    $subtotalaux = $subtotal/1.16;

    // Calcular el IVA (asumimos una tasa de 16%)
    $iva = $subtotalaux * 0.16;

    // Calcular el total de la compra (subtotal + IVA)
    $totalCompra = $subtotalaux + $iva;

    // Agregar el subtotal y el total de la compra a la factura
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(110 + 25 + 15 + 15, 10, 'Subtotal', 1);
    $pdf->Cell(30, 10, '$' . $subtotalaux, 1);
    $pdf->Ln(); // Salto de línea
    $pdf->Cell(110 + 25 + 15 + 15, 10, 'IVA (16%)', 1);
    $pdf->Cell(30, 10, '$' . $iva, 1);
    $pdf->Ln(); // Salto de línea
    $pdf->Cell(110 + 25 + 15 + 15, 10, 'Total de la Compra', 1);
    $pdf->Cell(30, 10, '$' . $totalCompra, 1);
    $pdf->Ln(); // Salto de línea

    // ... (código anterior)

    // Guardar la factura en el servidor o enviarla por correo electrónico
    // ...

    // Nombre del archivo de la factura
    $filename = 'factura.pdf';

    // Generar la factura y guardarla en el servidor
    $pdf->Output('F', $filename);

    

    // Mostrar un enlace para descargar la factura en una nueva pestaña del navegador
    echo '<div style="text-align: center;">';
    echo '<a style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; transition: background-color 0.3s ease-in-out; margin-right: 10px;" href="' . $filename . '" target="_blank">Descargar Factura</a>';
    echo '<a style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; transition: background-color 0.3s ease-in-out;" href="carrito.php">Regresar al Carrito</a>';
    echo '</div>';
} else {
    echo 'Error: El formulario no fue enviado correctamente.';
}