
<?php

include("./config/db.php");

interface Command {
    public function execute($usuario, $password, $conexion);
}

class LoginCommand implements Command {
    public function execute($usuario, $password, $conexion) {
        $consulta = "SELECT * FROM persona WHERE usuario = '$usuario' AND password = '$password'";
        $resultado = mysqli_query($conexion, $consulta);

        if ($usuario === 'daniela' && $password === '123456') {
            header("location: ./views/home.php");
            exit();
        } elseif ($usuario === 'jule' && $password === '123456') {
            header("location: ./views/pedidos.php");
            exit();
        } elseif ($usuario === 'marcelo' && $password === '123456') {
            header("location: ./views/home2.php");
            exit();
        
            ?>
            <h1>Error de autenticación</h1>
            <?php
            include("./index.html");
        }

        mysqli_free_result($resultado);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $command = new LoginCommand();
    $command->execute($usuario, $password, $conexion);

    mysqli_close($conexion);
}
?>