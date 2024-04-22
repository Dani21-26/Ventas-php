<?php
if (!empty($_GET["idUsuario"])) {
    include "../config/db.php"; // Asegúrate de incluir la conexión a la base de datos

    $id = $_GET["idUsuario"];
    $sql = $conexion->query("DELETE FROM persona WHERE idUsuario = $id");

    if ($sql === TRUE) {
        echo '<div class="alert alert-success">Usuario Eliminado</div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../views/usuario.php";
            }, 1000);
        </script>';
    } else {
        echo '<div class="alert alert-danger">Error al Eliminar: ' . $conexion->error . '</div>';
    }
}
?>
