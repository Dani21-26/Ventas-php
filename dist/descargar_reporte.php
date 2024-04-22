<?php
include "../config/db.php";


// Verificar si la conexión está establecida correctamente
if (!$conexion) {
    die("Error al conectar a la base de datos");
}

// Consulta para obtener todas las ventas
$sqlTodasLasVentas = "SELECT * FROM factura";
$resultadoTodasLasVentas = mysqli_query($conexion, $sqlTodasLasVentas);

// Crear el archivo de texto
$filename = 'reporte_ventas.txt';
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Datos de las ventas
while ($row = mysqli_fetch_assoc($resultadoTodasLasVentas)) {
    foreach ($row as $key => $value) {
        echo "$key: $value\n";
    }
    echo str_repeat('-', 20) . "\n"; // Separador entre cada venta
}

// Cerrar la conexión
mysqli_close($conexion);
?>

