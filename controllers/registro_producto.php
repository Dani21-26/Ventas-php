<?php
if (!empty($_POST["btnregistrar"])){
    if (!empty($_POST["nombre"]) and !empty($_POST["precio"])and !empty($_POST["stock"]) and !empty($_POST["caducidad"]) and !empty($_POST["idProveedor"])) {
        
        $nombre = $_POST["nombre"];
        $precio= $_POST["precio"];
        $stock = $_POST["stock"];
        $fechaCaducidad = $_POST["caducidad"];
        $idProveedor = $_POST["idProveedor"];
        

        $sql = $conexion->query("INSERT INTO producto (nombre, precio, stock, fechaCaducidad, idProveedor) VALUES ('$nombre', '$precio', '$stock', '$fechaCaducidad', '$idProveedor')");
        
        if ($sql === TRUE) {
            echo '<div class="alert alert-success">Producto Registrado</div>';
        } else {
            echo '<div class="alert alert-danger">Error en el Registro: ' . $conexion->error . '</div>';
        }

    } else {
        echo '<div class="alert alert-danger">Algunos campos están vacíos</div>';
    }
}
?>
