<?php
include '../config/db.php';

// Verificar si la conexión está establecida correctamente
if (!$conexion) {
    die("Error al conectar a la base de datos");
}

// Consulta para obtener todas las ventas
$sqlTodasLasVentas = "SELECT * FROM factura";
$resultadoTodasLasVentas = mysqli_query($conexion, $sqlTodasLasVentas);

// Verificar si la consulta fue exitosa
if ($resultadoTodasLasVentas) {
    // Obtener los resultados de la consulta
    $todasLasVentas = mysqli_fetch_all($resultadoTodasLasVentas, MYSQLI_ASSOC);
} else {
    $todasLasVentas = array(); // Si hay un error, inicializar como un array vacío
}
?>

<!-- Aquí mostrarás los detalles de todas las ventas, en un modal -->

<div class="container">
    <h2>Todas las Ventas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID Factura</th>
                <th>ID Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todasLasVentas as $venta) : ?>
                <tr>
                    <td><?php echo $venta['idFactura']; ?></td>
                    <td><?php echo $venta['idCliente']; ?></td>
                    <td><?php echo $venta['Total']; ?></td>
                    <td><?php echo $venta['fecha']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// Cerrar la conexión
mysqli_close($conexion);
?>
