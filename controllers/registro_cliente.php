<?php
include "../config/db.php";

if (isset($_POST['btnregistrarCliente']) && $_POST['btnregistrarCliente'] === 'ok') {
    $nombre = $_POST['nombre'];
    $nombreTienda = $_POST['nombreTienda'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $municipio = $_POST['municipio'];

    // Insertar datos en la tabla cliente
    $queryCliente = "INSERT INTO cliente (nombre, nombreTienda, telefono) VALUES ('$nombre', '$nombreTienda', '$telefono')";
    $resultCliente = $conexion->query($queryCliente);

    if ($resultCliente) {
        // Obtener el último ID insertado en cliente (asumiendo que el idCliente es autoincremental)
        $idCliente = $conexion->insert_id;

        // Insertar datos en la tabla ruta
        $queryRuta = "INSERT INTO ruta (idCliente, direccion, municipio) VALUES ('$idCliente', '$direccion', '$municipio')";
        $resultRuta = $conexion->query($queryRuta);

        if ($resultRuta) {
            echo "Cliente y ruta registrados correctamente.";
        } else {
            // Si la inserción en la tabla ruta falla, eliminar el registro de cliente insertado previamente para mantener la integridad
            $conexion->query("DELETE FROM cliente WHERE idCliente = '$idCliente'");
            echo "Error al insertar datos en la tabla ruta: " . $conexion->error;
        }
    } else {
        echo "Error al insertar datos en la tabla cliente: " . $conexion->error;
    }
}
?>
