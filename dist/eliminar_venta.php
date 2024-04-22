<?php
if (!empty($_GET["idFactura"])) {
    include "../config/db.php"; // Asegúrate de incluir la conexión a la base de datos

    $idVentaEliminar = $_GET["idFactura"];

    // Obtener el subtotal de la venta a eliminar
    $sqlSubtotalVenta = "SELECT subTotal FROM factura WHERE idFactura = $idVentaEliminar";
    $resultadoSubtotal = $conexion->query($sqlSubtotalVenta);
    $subtotalVenta = 0;

    if ($resultadoSubtotal && $resultadoSubtotal->num_rows > 0) {
        $subtotalVenta = $resultadoSubtotal->fetch_assoc()['subTotal'];
    }

    // Realizar la eliminación de la venta
    $sqlEliminarVenta = "DELETE FROM factura WHERE idFactura = $idVentaEliminar";
    if ($conexion->query($sqlEliminarVenta) === TRUE) {
        echo '<div class="alert alert-success">Venta Eliminada</div>';
        
        // Llamar a una función o método que actualice el total de ventas
        actualizarTotalVentas($conexion, $subtotalVenta);

        echo '<script>
            setTimeout(function() {
                window.location.href = "../views/venta.php";
            }, 1000);
        </script>';
    } else {
        echo '<div class="alert alert-danger">Error al Eliminar: ' . $conexion->error . '</div>';
    }
}

function actualizarTotalVentas($conexion, $subtotalVentaEliminado) {
    // Lógica para actualizar el total de ventas restando el subtotal eliminado
    $sqlActualizarTotal = "UPDATE factura SET Total = Total - $subtotalVentaEliminado";
    if ($conexion->query($sqlActualizarTotal) === TRUE) {
        echo "Total de ventas actualizado correctamente";
    } else {
        echo "Error al actualizar el total de ventas: " . $conexion->error;
    }
}

    // Ob




?>