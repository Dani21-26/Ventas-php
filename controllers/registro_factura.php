<?php
// Incluye el archivo de conexión a la base de datos
include "../config/db.php";

// Verifica si se ha enviado el formulario de registro
if(isset($_POST['btnregistrar']) && $_POST['btnregistrar'] === 'ok') {
    // Recibe los datos del formulario de venta
    $idVenta = $_POST['idVenta'];
    $fecha = $_POST['fecha'];
    $idCliente = $_POST['idCliente'];
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $subTotal = $_POST['subTotal'];

    // Calcula el total (puedes ajustar esto según tus necesidades)
    $total = $cantidad * $precio;

    // Conectar a la base de datos
    $conn = conexion();

    // Inserta datos en la tabla 'factura'
    $sql_insert = $conn->prepare("INSERT INTO factura (idVenta, fecha, idCliente, idProducto, cantidad, precio, subTotal, Total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $sql_insert->bind_param('issiiddd', $idVenta, $fecha, $idCliente, $idProducto, $cantidad, $precio, $subTotal, $total);

    if ($sql_insert->execute()) {
        echo "Los datos se han insertado correctamente en la tabla factura.";
        // Puedes redirigir a una página de éxito o realizar otras acciones necesarias
    } else {
        echo "Error al insertar los datos en la tabla factura: " . $conn->error;
    }

    // Cierra la conexión y la declaración
    $sql_insert->close();
    $conn->close();
}

// ... Resto de tu código
?>
