<?php
include "../config/db.php";

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["idUsuario"]) && !empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $id = $_POST["idUsuario"];
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        $sql = $conexion->query("UPDATE persona SET usuario='$usuario', password='$password' WHERE idUsuario=$id ");

        if ($sql === TRUE) {
            header("location: ../views/usuario.php");
            exit; // Añade un exit después de la redirección
        } else {
            echo '<div class="alert alert-danger">Error al modificar</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Algunos campos están vacíos</div>';
    }
}
?>
