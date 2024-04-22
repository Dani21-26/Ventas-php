<?php
include "../config/db.php";

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["idFactura"]) and !empty($_POST["fecha"]) and !empty($_POST["idCliente"])and !empty($_POST["idProducto"]) and !empty($_POST["cantidad"]) and !empty($_POST["precio"])and !empty($_POST["subTotal"])and !empty($_POST["Total"])) {
        $id = $_POST["idFactura"];
        $fecha = $_POST['fecha'];
        $cantidad = $_POST['cantidad'];;

        $sql = $conexion->query("UPDATE factura SET fecha='$fecha',  cantidad='$cantidad' WHERE idFactura=$id ");

        if ($sql === TRUE) {
            header("location: ../views/venta.php");
            exit; // Añade un exit después de la redirección
            
        } else {
            echo '<div class="alert alert-danger">Error al modificar</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Algunos campos están vacíos</div>';
    }
}
?>
