<?php
// Incluye el archivo de conexión a la base de datos
include "../config/db.php";

// Verifica si se recibió un ID de venta válido
if(isset($_GET['idVenta'])) {
    $idVenta = $_GET['idVenta'];

    // Consulta para obtener los datos de la venta específica
    $query = "SELECT * FROM venta WHERE idVenta = $idVenta";
    $result = $conexion->query($query);

    if ($result && $result->num_rows > 0) {
        // Configuración e inicio de PDF
        require('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Encabezado de la factura
        $pdf->Cell(0, 10, 'Factura de Venta', 0, 1, 'C');
        $pdf->Ln(10); // Salto de línea

        // Obtención de datos de la venta
        $venta = $result->fetch_assoc();

        // Agregar los detalles de la venta al PDF
        $pdf->Cell(40, 10, 'ID de Venta:', 0);
        $pdf->Cell(0, 10, $venta['idVenta'], 0, 1);

        $pdf->Cell(40, 10, 'Fecha:', 0);
        $pdf->Cell(0, 10, $venta['fecha'], 0, 1);

        // ... Agregar más detalles según tu estructura de datos

        // Nombre del archivo PDF y salida
        $pdfName = 'factura_' . $idVenta . '.pdf';
        $pdf->Output('D', $pdfName); // Descarga el PDF con el nombre especificado
        exit();
    }
}
?>
