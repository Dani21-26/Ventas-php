<?php

require_once  '../vendor/autoload.php';


$conexion = mysqli_connect("localhost", "root", "", "bodega3");


if (!$conexion) {
    die("La conexión falló: " . mysqli_connect_error());
}

// Iniciar o reanudar la sesión
session_start();

// Verificar si se ha enviado el formulario
if (isset($_POST['procesar_compra'])) {
    $cliente_id = $_POST['cliente'];
    $ruta_id = $_POST['ruta'];

    $fecha_factura = date("Y-m-d");

    // Insertar la factura en la tabla factura
    $sql_insert_factura = "INSERT INTO factura (idCliente, Total, fecha) VALUES ($cliente_id, 0, '$fecha_factura')";

    if (mysqli_query($conexion, $sql_insert_factura)) {
        // Obtener el ID de la última factura insertada
        $id_factura = mysqli_insert_id($conexion);

        // Obtener el contenido del carrito de la sesión
        $carrito = $_SESSION['carrito'];

        // Calcular el total de la factura y actualizar la factura en la base de datos
        $total_factura = 0;
        foreach ($carrito as $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total_factura += $subtotal;

            // Insertar detalle de factura en la tabla detalle_factura
            $sql_insert_detalle = "INSERT INTO detalle_factura (idFactura, idProducto, cantidad, Total) VALUES ($id_factura, {$item['idProducto']}, {$item['cantidad']}, $subtotal)";

            if (!mysqli_query($conexion, $sql_insert_detalle)) {
                echo "Error al insertar detalle de factura: " . mysqli_error($conexion);
            }
        }

        $sql_update_total = "UPDATE factura SET Total = $total_factura WHERE idFactura = $id_factura";

        if (!mysqli_query($conexion, $sql_update_total)) {
            
            echo "Error al actualizar el total en la factura: " . mysqli_error($conexion);
        }

             // Generar el PDF con los detalles de la factura
             $mpdf = new \Mpdf\Mpdf();
             $html = '
                 <h2>Detalles de la Factura</h2>
                 <table border="1">
                     <tr>
                         <th>Producto</th>
                         <th>Precio Unitario</th>
                         <th>Cantidad</th>
                         <th>Subtotal</th>
                     </tr>';
             
             // Agregar detalles de la factura al HTML
             foreach ($carrito as $item) {
                 $html .= '<tr>';
                 $html .= '<td>' . $item['nombre'] . '</td>';
                 $html .= '<td>$' . $item['precio'] . '</td>';
                 $html .= '<td>' . $item['cantidad'] . '</td>';
                 $html .= '<td>$' . number_format($item['precio'] * $item['cantidad'], 2) . '</td>';
                 $html .= '</tr>';
             }
            
             $html .= '
                 <tr>
                     <td colspan="3"><strong>Total</strong></td>
                     <td>$' . number_format($total_factura, 2) . '</td>
                 </tr>
             </table>';
            
             // Agregar información del cliente y la ruta
             $html .= '
                 <h2>Información del Cliente y Ruta</h2>
                 <table border="1">
                     <tr>
                         <th>Cliente</th>
                         <th>Ruta</th>
                         <th>Fecha</th>
                     </tr>
                     <tr>
                         <td>' . obtenerNombreCliente($conexion, $cliente_id) . '</td>
                         <td>' . obtenerDireccionRuta($conexion, $ruta_id) . '</td>
                         <td>' . $fecha_factura . '</td>
                     </tr>
                 </table>';
            
             // Agregar el HTML al PDF
             $mpdf->WriteHTML($html);

   


        // Guardar el PDF en el servidor o enviarlo al navegador
        $mpdf->Output('factura.pdf', 'D');

        unset($_SESSION['carrito']);

        // Redirigir 
        header("Location: ../views/tomar.php");
        exit();
    } else {
        // Manejar el error si la inserción en factura falla
        echo "Error al insertar factura: " . mysqli_error($conexion);
    }
}

// Funciones adicionales para obtener información del cliente y la ruta
function obtenerNombreCliente($conexion, $cliente_id) {
    $sql = "SELECT nombre FROM cliente WHERE idCliente = $cliente_id";
    $resultado = mysqli_query($conexion, $sql);
    $cliente = mysqli_fetch_assoc($resultado);
    return $cliente['nombre'];
}

function obtenerDireccionRuta($conexion, $ruta_id) {
    $sql = "SELECT direccion, municipio FROM ruta WHERE idRuta = $ruta_id";
    $resultado = mysqli_query($conexion, $sql);
    $ruta = mysqli_fetch_assoc($resultado);
    return $ruta['direccion'] . ', ' . $ruta['municipio'];
}


?>
