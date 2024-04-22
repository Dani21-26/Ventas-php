<?php
include '../menu/nav.php';
include "../config/db.php";
// Realizar la consulta SQL
$sql = "SELECT COUNT(*) AS TotalProductos FROM producto";
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Obtener el resultado de la consulta
    $fila = mysqli_fetch_assoc($resultado);
    $totalProductos = $fila["TotalProductos"];
} else {
    $totalProductos = 0;
}

// Consulta para obtener los ingresos totales
$sqlIngresos = "SELECT SUM(Total) AS IngresosTotales FROM factura";
$resultadoIngresos = mysqli_query($conexion, $sqlIngresos);

// Verificar si la consulta fue exitosa
if ($resultadoIngresos) {
    // Obtener el resultado de la consulta
    $filaIngresos = mysqli_fetch_assoc($resultadoIngresos);
    $ingresosTotales = $filaIngresos["IngresosTotales"];
} else {
    $ingresosTotales = 0;
}

// Consulta para obtener el número de clientes
$sqlClientes = "SELECT COUNT(*) AS TotalClientes FROM cliente";
$resultadoClientes = mysqli_query($conexion, $sqlClientes);

// Verificar si la consulta fue exitosa
if ($resultadoClientes) {
    // Obtener el resultado de la consulta
    $filaClientes = mysqli_fetch_assoc($resultadoClientes);
    $totalClientes = $filaClientes["TotalClientes"];
} else {
    $totalClientes = 0;
}

// Consulta para obtener el número total de proveedores
$sqlProveedores = "SELECT COUNT(*) AS TotalProveedores FROM proveedor";
$resultadoProveedores = mysqli_query($conexion, $sqlProveedores);

// Verificar si la consulta fue exitosa
if ($resultadoProveedores) {
    // Obtener el resultado de la consulta
    $filaProveedores = mysqli_fetch_assoc($resultadoProveedores);
    $totalProveedores = $filaProveedores["TotalProveedores"];
} else {
    $totalProveedores = 0;
}

// Consulta para obtener las últimas 5 ventas
$sqlVentasRecientes = "SELECT idFactura, Total, fecha FROM factura ORDER BY fecha DESC LIMIT 5";
$resultadoVentasRecientes = mysqli_query($conexion, $sqlVentasRecientes);

// Verificar si la consulta fue exitosa
if ($resultadoVentasRecientes) {
    // Obtener los resultados de la consulta
    $ventasRecientes = mysqli_fetch_all($resultadoVentasRecientes, MYSQLI_ASSOC);
} else {
    $ventasRecientes = array(); // Si hay un error, inicializar como un array vacío
}

// Consulta para obtener las ventas por mes
$sqlVentasPorMes = "SELECT MONTH(fecha) AS MesNumero, DATE_FORMAT(fecha, '%M') AS MesNombre, SUM(Total) AS VentasPorMes FROM factura GROUP BY MONTH(fecha)";
$resultadoVentasPorMes = mysqli_query($conexion, $sqlVentasPorMes);

// Verificar si la consulta fue exitosa
if ($resultadoVentasPorMes) {
    // Obtener los resultados de la consulta
    $ventasPorMes = mysqli_fetch_all($resultadoVentasPorMes, MYSQLI_ASSOC);
} else {
    $ventasPorMes = array(); // Si hay un error, inicializar como un array vacío
}



?>
<!-- Fin Navbar -->
<!-- Page Content -->
<div id="content" class="bg-grey w-100">

    <section class="bg-light py-3">
        <div class="container">

            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <h1 class="font-weight-bold mb-0">Bienvenida Daniela</h1>

                    <p class="lead text-muted">Revisa la última información</p>
                </div>
                <div class="col-lg-3 col-md-4 d-flex">
                <button class="btn btn-primary w-100 align-self-center" onclick="window.location.href='../dist/descargar_reporte.php'">Descargar reporte</button>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-mix py-3">

        <div class="container">
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="row">
                    <div class="col-lg-3 col-md-6 d-flex stat my-3">
                        <div class="mx-auto">
                                <h6 class="text-muted">Ingresos</h6>
                                <h3 class="font-weight-bold">$<?php echo number_format($ingresosTotales, 2); ?></h3>
                                <h6 class="text-success"><i class="icon ion-md-arrow-dropup-circle"></i> ingresos</h6>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 d-flex stat my-3">
                            <div class="mx-auto">
                                <h6 class="text-muted">Productos activos</h6>
                                <h3 class="font-weight-bold"><?php echo $totalProductos; ?></h3>
                                <h6 class="text-success"><i class="icon ion-md-arrow-dropup-circle"></i> pructos</h6>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 d-flex stat my-3">
                            <div class="mx-auto">
                                <h6 class="text-muted">No. de clientes</h6>
                                <h3 class="font-weight-bold"><?php echo $totalClientes; ?></h3>
                                <h6 class="text-success"><i class="icon ion-md-arrow-dropup-circle"></i> clientes</h6>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 d-flex my-3">
                            <div class="mx-auto">
                                <h6 class="text-muted">No. de proveedores</h6>
                                <h3 class="font-weight-bold"><?php echo $totalProveedores; ?></h3>
                                <h6 class="text-success"><i class="icon ion-md-arrow-dropup-circle"></i> proveedores</h6>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 my-3">
                    <div class="card rounded-0">
                        <div class="card-header bg-light">
                            <h6 class="font-weight-bold mb-0">Ventas por mes </h6>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="300" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 my-3">
    <div class="card rounded-0">
        <div class="card-header bg-light">
            <h6 class="font-weight-bold mb-0">Ventas recientes</h6>
        </div>
        <div class="card-body pt-2">
            <?php foreach ($ventasRecientes as $venta) : ?>
                <div class="d-flex border-bottom py-2">
                    <div class="d-flex mr-3">
                        <h2 class="align-self-center mb-0"><i class="icon ion-md-pricetag"></i></h2>
                    </div>
                    <div class="align-self-center">
                        <h6 class="d-inline-block mb-0">$<?php echo number_format($venta['Total'], 2); ?></h6>
                        <small class="d-block text-muted">Venta #<?php echo $venta['idFactura']; ?> - <?php echo $venta['fecha']; ?></small>
                    </div>
                </div>
            <?php endforeach; ?>
            <button class="btn btn-primary w-100" data-toggle="modal" data-target="#verTodasVentasModal">Ver todas</button>
        </div>
    </div>
</div>
            </div>
        </div>
    </section>

</div>

</div>
</div>

<!-- Modal para ver todas las ventas -->
<div class="modal fade" id="verTodasVentasModal" tabindex="-1" role="dialog" aria-labelledby="verTodasVentasModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verTodasVentasModalLabel">Todas las Ventas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <?php include '../dist/ver_todas_ventas.php'; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

<!--grafica de ventas por mes -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_column($ventasPorMes, 'MesNombre')); ?>,
            datasets: [{
                label: 'Ventas',
                data: <?php echo json_encode(array_column($ventasPorMes, 'VentasPorMes')); ?>,
                backgroundColor: [
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5',
                    '#12C9E5'
                    
                ],
                maxBarThickness: 30,
                maxBarLength: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    function toggleMenu() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("active");
    }

    document.getElementById('logoutButton').addEventListener('click', function() {
        window.location.href = '../index.html';
    });

    // script para abrir el modal cuando se hace clic en el botón "Ver todas"
    document.getElementById('verTodasLasVentas').addEventListener('click', function() {
        $('#verTodasVentasModal').modal('show');
    });
</script>

<script>
    function toggleMenu() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("active");
    }

    document.getElementById('logoutButton').addEventListener('click', function() {
        window.location.href = '../index.html';
    });
</script>



</body>

</html>