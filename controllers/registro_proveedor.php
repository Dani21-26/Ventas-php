<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["telefono"]) && !empty($_POST["direccion"])) {
        
        
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];
        
        // Corregir el nombre de la columna direccion
        $sql = $conexion->query("INSERT INTO proveedor (nombre, telefono, direccion) VALUES ('$nombre', '$telefono', '$direccion')");
        
        if ($sql === TRUE) {
            echo '<div class="alert alert-success">Proveedor Registrado</div>';
        } else {
            echo '<div class="alert alert-danger">Error en el Registro: ' . $conexion->error . '</div>';
        }

    } else {
        echo '<div class="alert alert-danger">Algunos campos están vacíos</div>';
    }
}
?>
