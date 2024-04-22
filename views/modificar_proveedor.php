<?php
include "../config/db.php";

$id = $_GET["idProveedor"];
$sql = $conexion->query("SELECT * FROM proveedor WHERE idProveedor = $id");

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
    <form class="col-4 p-3 m-auto" method="POST" action="../dist/editar_proveedor.php">
        <h4 class="text-center alert-secondary">Modificar Proveedor</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">idProveedor</label>
            <input type="text" class="form-control" name="idProveedor" value="<?= $datos->idProveedor?>" readonly>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Telefono</label>
            <input type="text" class="form-control" name="telefono" value="<?= $datos->telefono ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Direccion</label>
            <input type="text" class="form-control" name="direccion" value="<?= $datos->direccion ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Actualizar proveedor</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
</body>
</html>
<?php
} else {
    echo '<div class="alert alert-danger">No se encontraron datos para este proveedores</div>';
}
?>
