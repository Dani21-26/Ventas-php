<?php
include "../config/db.php";

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["idProveedor"]) && !empty($_POST["nombre"]) && !empty($_POST["telefono"]) && !empty($_POST["direccion"])) {
        $id = $_POST["idProveedor"];
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];


        $sql = $conexion->query("UPDATE proveedor SET nombre='$nombre', telefono='$telefono', direccion='$direccion' WHERE idProveedor=$id ");

        if ($sql === TRUE) {
            header("location: ../views/proveedor.php");
            exit; // Añade un exit después de la redirección
        } else {
            echo '<div class="alert alert-danger">Error al modificar</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Algunos campos están vacíos</div>';
    }
}
?>
