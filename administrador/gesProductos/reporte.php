<?php
require('../gesProductos/fpdf/fpdf.php');
$conn = mysqli_connect('localhost', 'root', '12345', 'happynakda');

if (!$conn) {
    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
}

$query = "SELECT * FROM tventas";
$result = mysqli_query($conn, $query);

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Ventas', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    function CreateTable($header, $data, $cellWidth, $cellHeight)
    {
        $this->SetFont('Arial', 'B', 10);
        foreach ($header as $col) {
            $this->Cell($cellWidth, $cellHeight, $col, 1);
        }
        $this->Ln();

        $totalVentas = 0; // Inicializar el total de ventas

        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            foreach ($row as $key => $col) {
                $this->Cell($cellWidth, $cellHeight, $col, 1);
                if ($key === 5) { // Columna "total"
                    $totalVentas += $col; // Sumar al total de ventas
                }
            }
            $this->Ln();
        }

        // Agregar fila de totales
        $this->SetFont('Arial', 'B', 10);
        $this->Cell($cellWidth * 5, $cellHeight, 'Total Ventas:', 1, 0, 'R');
        $this->Cell($cellWidth, $cellHeight, '$' . number_format($totalVentas, 2), 1);
        $this->Cell($cellWidth, $cellHeight, '', 1); // Celda vacía para el espacio
        $this->Ln();
    }
}

$pdf = new PDF();
$pdf->AddPage();

$header = array('N_venta', 'Fecha', 'Sucursal', 'Usuario', 'Cantidad', 'total', 'N_Producto');
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        $row['id_ventas'],
        $row['ve_datetime'],
        $row['id_sucursal'],
        $row['id_user'],
        $row['ve_cantidad'],
        $row['t_precio'],
        $row['id_producto']
    );
}

$cellWidth = 25; // Define el ancho de celda
$cellHeight = 10; // Define la altura de celda

$pdf->CreateTable($header, $data, $cellWidth, $cellHeight);

mysqli_free_result($result);
mysqli_close($conn);

$pdf->Output();
?>
