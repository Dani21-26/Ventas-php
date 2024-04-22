<?php
include "../config/db.php";

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["idProveedor"]) && !empty($_POST["nombre"]) && !empty($_POST["precio"]) && !empty($_POST["stock"]) && !empty($_POST["fechaCaducidad"])) {

        $idProducto = $_POST["idProducto"]; // Agrega esta línea para obtener el idProducto del formulario

        $idProveedor = $_POST["idProveedor"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];
        $fechaCaducidad = $_POST["fechaCaducidad"];

        // Query para actualizar los datos del producto
        $sql = $conexion->query("UPDATE producto SET idProveedor='$idProveedor', nombre='$nombre', precio='$precio', stock='$stock', fechaCaducidad='$fechaCaducidad' WHERE idProducto=$idProducto");

        if ($sql === TRUE) {
            header("location: ../views/producto.php");
            exit;
        } else {
            echo '<div class="alert alert-danger">Error al actualizar el producto: ' . $conexion->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Algunos campos están vacíos</div>';
    }
}
?>
