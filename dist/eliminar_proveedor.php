<?php
if (!empty($_GET["idProveedor"])) {
    include "../config/db.php"; // Asegúrate de incluir la conexión a la base de datos

    $id = $_GET["idProveedor"];
    $sql = $conexion->query("DELETE FROM proveedor WHERE idProveedor = $id");

    if ($sql === TRUE) {
        echo '<div class="alert alert-success">Proveedor Eliminado</div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../views/Proveedor.php";
            }, 1000);
        </script>';
    } else {
        echo '<div class="alert alert-danger">Error al Eliminar: ' . $conexion->error . '</div>';
    }
}
?>
