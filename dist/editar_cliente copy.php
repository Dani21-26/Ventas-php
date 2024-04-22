<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnregistrar'])) {
    $id = $_POST["idCliente"];
    $nombre = $_POST["nombre"];
    $nombreTienda = $_POST["nombreTienda"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $municipio = $_POST["municipio"];

    // Actualizar datos en la tabla 'cliente'
    $sqlUpdateCliente = "UPDATE cliente SET nombre = '$nombre', nombreTienda = '$nombreTienda', telefono = '$telefono' WHERE idCliente = $id";
    $resultCliente = $conexion->query($sqlUpdateCliente);

    // Actualizar datos en la tabla 'ruta'
    $sqlUpdateRuta = "UPDATE ruta SET direccion = '$direccion', municipio = '$municipio' WHERE idCliente = $id";
    $resultRuta = $conexion->query($sqlUpdateRuta);

    if ($resultCliente && $resultRuta) {
        echo '<div class="alert alert-success">Los datos se han actualizado correctamente en ambas tablas.</div>';
    } else {
        echo '<div class="alert alert-danger">Hubo un problema al actualizar los datos.</div>';
    }
}

?>
