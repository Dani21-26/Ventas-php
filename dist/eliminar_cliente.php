<?php
if (!empty($_GET["idCliente"])) {
    include "../config/db.php"; // Asegúrate de incluir la conexión a la base de datos

    $id = $_GET["idCliente"];

    // Eliminar de la tabla ruta
    $sqlDeleteRuta = $conexion->query("DELETE FROM ruta WHERE idCliente = $id");

    if ($sqlDeleteRuta === TRUE) {
        // Si se elimina de la tabla ruta, procede a eliminar de la tabla cliente
        $sqlDeleteCliente = $conexion->query("DELETE FROM cliente WHERE idCliente = $id");

        if ($sqlDeleteCliente === TRUE) {
            echo '<div class="alert alert-success">Cliente Eliminado</div>';
            echo '<script>
                setTimeout(function() {
                    window.location.href = "../views/cliente.php";
                }, 1000);
            </script>';
        } else {
            echo '<div class="alert alert-danger">Error al Eliminar de la tabla cliente: ' . $conexion->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Error al Eliminar de la tabla ruta: ' . $conexion->error . '</div>';
    }
}

?>
