<?php
include "../config/db.php";

if (!empty($_POST["btnregistrar"])){
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])){
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
    
        $sql = $conexion->query("INSERT INTO persona(usuario, password) VALUES ('$usuario', '$password')");
        if ($sql === true){
            echo '<div class="alert alert-success">Usuario Registrado</div>';
        } else{
            echo '<div class="alert alert-danger">Error en el Registro</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Algunos campos están vacíos</div>';
    }
}
?>
