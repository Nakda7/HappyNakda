<?php
// Importar la librería FPDF
require('../gesProductos/fpdf/fpdf.php'); // Asegúrate de ajustar la ruta correcta

// Establecer la conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '12345', 'happynakda');

// Verificar la conexión
if (!$conn) {
    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
}

// Consulta para obtener todos los empleados de la tabla tusers
$query = "SELECT * FROM tusers WHERE id_tipoCliente =2";

$result = mysqli_query($conn, $query);

// Crear una instancia de la clase FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Agregar el contenido del reporte
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, 'Reporte de Empleados Registrados', 0, 1, 'C');
$pdf->Ln(10); // Salto de línea

// Crear la tabla para mostrar los empleados
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(50, 10, 'Correo', 1, 0, 'C');
$pdf->Cell(30, 10, 'Contrasena', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);

// Recorrer los registros y mostrar los empleados en la tabla
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 8, $row['id_user'], 1, 0, 'C');
    $pdf->Cell(50, 8, $row['us_nombre'], 1, 0, 'C');
    $pdf->Cell(50, 8, $row['us_correo'], 1, 0, 'C');
    $pdf->Cell(30, 8, $row['us_contraseña'], 1, 1, 'C');
}

// Cerrar el resultado del query y la conexión a la base de datos
mysqli_free_result($result);
mysqli_close($conn);

// Generar el reporte en PDF
$pdf->Output();
?>