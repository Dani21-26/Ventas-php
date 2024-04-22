<?php
include "../config/db.php";

$id = $_GET["idUsuario"];
$sql = $conexion->query("SELECT * FROM persona WHERE idUsuario = $id");

if ($sql && $sql->num_rows > 0) {
    $datos = $sql->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Editar</title>
</head>
<body>
    <form class="col-4 p-3 m-auto" method="POST" action="../dist/editar_persona.php">
        <h4 class="text-center alert-secondary">Modificar Usuario</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">idUsuario</label>
            <input type="text" class="form-control" name="idUsuario" value="<?= $datos->idUsuario ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" value="<?= $datos->usuario ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" value="<?= $datos->password ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Actualizar Usuario</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
} else {
    echo '<div class="alert alert-danger">No se encontraron datos para este usuario</div>';
}
?>
