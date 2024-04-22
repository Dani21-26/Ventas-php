<?php
if (!empty($_POST["btnregistrarVenta"])) {

    // Establecer la conexión a la base de datos
    include "../config/db.php";

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Función para sanitizar los datos ingresados
    function limpiarDatos($datos)
    {
        global $conexion;
        return mysqli_real_escape_string($conexion, trim($datos));
    }

    // Obtener y sanitizar los datos del formulario
    $idFactura = limpiarDatos($_POST['idFactura']);
    $fecha = limpiarDatos($_POST['fecha']); // 
    $idCliente = limpiarDatos($_POST['idCliente']);
    $totalVenta = limpiarDatos($_POST['Total']);
    $idProductoSeleccionado = limpiarDatos($_POST['idProducto']); 



    // Formatear la fecha al formato de MySQL (YYYY-MM-DD)


    // Insertar la información de la venta en la tabla 'factura'
    $query = "INSERT INTO factura (idFactura,fecha, idCliente, Total, idProducto) VALUES ('$idFactura', '$fecha', '$idCliente', '$totalVenta', '$idProductoSeleccionado')";

    if ($conexion->query($query) === TRUE) {
        $idFactura = $conexion->insert_id;

        // Verificar si $_POST['idProducto'] es un array antes de iterar sobre él
        if (is_array($_POST['idProducto'])) {
            // Iterar sobre los productos vendidos y guardarlos en la tabla 'detalles_factura'
            foreach ($_POST['idProducto'] as $key => $idProducto) {
                $cantidad = limpiarDatos($_POST['cantidad'][$key]);
                $totalVentaProducto = limpiarDatos($_POST['Total'][$key]);

                // Insertar detalles de productos vendidos en la tabla 'detalles_factura'
                $detalleQuery = "INSERT INTO detalles_factura (idFactura, idProducto, cantidad, Total) 
                                VALUES ('$idFactura', '$idProducto', '$cantidad', '$totalVentaProducto')";

                $conexion->query($detalleQuery);
            }
        }

        echo "La venta se ha procesado correctamente.";
    } else {
        echo "Error al procesar la venta: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>
