<?php
// Importar la librería FPDF
require('../gesProductos/fpdf/fpdf.php');
// Establecer la conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '12345', 'happynakda');

// Verificar la conexión
if (!$conn) {
    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
}

// Consulta para obtener todos los productos de la tabla tproductos
$query = "SELECT * FROM tproductos";

$result = mysqli_query($conn, $query);

// Crear una instancia de la clase FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Agregar el contenido del reporte
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, 'Reporte de Productos Registrados', 0, 1, 'C');
$pdf->Ln(10); // Salto de línea

// Crear la tabla para mostrar los productos
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C');
$pdf->Cell(85, 10, 'Nombre', 1, 0, 'C');

$pdf->Cell(25, 10, 'Precio de Compra', 1, 0, 'C');
$pdf->Cell(25, 10, 'Marca', 1, 0, 'C');
$pdf->Cell(25, 10, 'Color', 1, 0, 'C');
$pdf->Cell(25, 10, 'Gama', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);

// Recorrer los registros y mostrar los productos en la tabla
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 4, $row['id_producto'], 1, 0, 'C');
    $pdf->Cell(85, 8, $row['pr_nombre'], 1, 0, 'C');
    
    $pdf->Cell(25, 8, $row['pr_precioCompra'], 1, 0, 'C');
    $pdf->Cell(25, 8, $row['pr_marca'], 1, 0, 'C');
    $pdf->Cell(25, 8, $row['pr_color'], 1, 0, 'C');
    $pdf->Cell(25, 8, $row['pr_gama'], 1, 1, 'C');
}

// Cerrar el resultado del query y la conexión a la base de datos
mysqli_free_result($result);
mysqli_close($conn);

// Generar el reporte en PDF
$pdf->Output();