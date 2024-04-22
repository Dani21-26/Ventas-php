<?php
// Establecer la conexión a la base de datos (incluyendo tu archivo de conexión)
include "../config/db.php";

// Función para guardar los detalles de la factura
function guardarDetallesFactura($idCliente, $idProducto, $idFactura, $total) {
    global $conexion; // Variable de conexión a la base de datos

    // consulta SQL para insertar los detalles de la factura
    $query = "INSERT INTO detalle_factura (idCliente, idProducto, idFactura, Total) VALUES (?, ?, ?, ?)";

    // Preparar la sentencia
    $stmt = mysqli_prepare($conexion, $query);

    // Vincular parámetros y ejecutar la sentencia
    mysqli_stmt_bind_param($stmt, "iiid", $idCliente, $idProducto, $idFactura, $total);
    $resultado = mysqli_stmt_execute($stmt);

    // Verificar si la inserción fue exitosa
    if ($resultado) {
        return true; // Éxito al guardar los detalles de la factura
    } else {
        return false; // Fallo al guardar los detalles de la factura
    }
}

// función para guardar los detalles de la factura
if (isset($_POST['btnregistrarVenta'])) {
    // Obtener los datos de la factura desde el formulario
    $idCliente = $_POST['idCliente'];
    $idProducto = $_POST['idProducto'];
    $idFactura = $_POST['idFactura'];
    $total = $_POST['Total'];

    // Llamar a la función para guardar los detalles de la factura
    $guardado = guardarDetallesFactura($idCliente, $idProducto, $idFactura, $total);

    if ($guardado) {
        echo "Detalles de la factura guardados exitosamente en la tabla detalle_factura.";
    } else {
        echo "Error al guardar los detalles de la factura.";
    }
}
?>
