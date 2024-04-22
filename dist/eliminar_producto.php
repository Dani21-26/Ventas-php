<?php
if (!empty($_GET["idProducto"])) {
    include "../config/db.php"; // Asegúrate de incluir la conexión a la base de datos

    $id = $_GET["idProducto"];
    $sql = $conexion->query("DELETE FROM producto WHERE idProducto = $id");

    if ($sql === TRUE) {
        echo '<div class="alert alert-success">Producto Eliminado</div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../views/Producto.php";
            }, 1000);
        </script>';
    } else {
        echo '<div class="alert alert-danger">Error al Eliminar: ' . $conexion->error . '</div>';
    }
}
?>
