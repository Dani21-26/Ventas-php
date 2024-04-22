<?php
include "../config/db.php";

$id = $_GET["idProducto"];
$sql = $conexion->query("SELECT * FROM producto WHERE idProducto = $id");

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
    <form class="col-4 p-3 m-auto" method="POST" action="../dist/editar_producto.php">
        <h4 class="text-center alert-secondary">Modificar producto</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">idProducto</label>
            <input type="text" class="form-control" name="idProducto" value="<?= $datos->idProducto ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">idProveedor</label>
            <input type="text" class="form-control" name="idProveedor" value="<?= $datos->idProveedor ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Precio</label>
            <input type="text" class="form-control" name="precio" value="<?= $datos->precio ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Stock</label>
            <input type="text" class="form-control" name="stock" value="<?= $datos->stock ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Fecha de Caducidad</label>
            <input type="text" class="form-control" name="fechaCaducidad" value="<?= $datos->fechaCaducidad ?>">
        </div>
        
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Actualizar producto</button>
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
