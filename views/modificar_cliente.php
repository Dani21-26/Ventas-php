<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnregistrar'])) {
    $id = $_POST["idCliente"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $municipio = $_POST["municipio"];

    // Actualizar datos en la tabla 'cliente'
    $sqlUpdateCliente = "UPDATE cliente SET nombre = '$nombre', telefono = '$telefono' WHERE idCliente = $id";
    $resultCliente = $conexion->query($sqlUpdateCliente);

    // Actualizar datos en la tabla 'ruta'
    $sqlUpdateRuta = "UPDATE ruta SET direccion = '$direccion', municipio = '$municipio' WHERE idCliente = $id";
    $resultRuta = $conexion->query($sqlUpdateRuta);

    if ($resultCliente && $resultRuta) {
        echo '<div class="alert alert-success">Los datos se han actualizado correctamente en ambas tablas.</div>';
    } else {
        echo '<div class="alert alert-danger">Hubo un problema al actualizar los datos.</div>';
    }
}
?>
<?php
include "../config/db.php";

$id = $_GET["idCliente"];
$sql = $conexion->query("SELECT * FROM cliente WHERE idCliente = $id");

if ($sql && $sql->num_rows > 0) {
    $datos = $sql->fetch_object();
    $idCliente = $datos->idCliente; // Asumiendo que el campo que vincula cliente con ruta sea idCliente

    // Seleccionar todos los datos de la tabla ruta para el cliente seleccionado
    $sqlRuta = $conexion->query("SELECT * FROM ruta WHERE idCliente = $idCliente");

    if ($sqlRuta && $sqlRuta->num_rows > 0) {
        // Recorrer los datos de la tabla ruta asociados al cliente seleccionado
        $datosRuta = $sqlRuta->fetch_object(); // Obtener un solo registro de la tabla ruta
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <title>Editar</title>
        </head>

        <body>
            <form class="col-4 p-3 m-auto" method="POST" action="../dist/editar_cliente.php">
                <h4 class="text-center alert-secondary">Modificar Cliente</h4>
                <div class="mb-3">
                    <label for="idCliente" class="form-label">Id Cliente</label>
                    <input type="text" class="form-control" name="idCliente" value="<?= $datos->idCliente ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
                </div>

                <div class="mb-3">
                    <label for="nombreTienda" class="form-label">Nombre del Negocio</label>
                    <input type="text" class="form-control" name="nombreTienda" value="<?= $datos->nombreTienda ?>">
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" value="<?= $datos->telefono ?>">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="<?= isset($datosRuta->direccion) ? $datosRuta->direccion : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="municipio" class="form-label">Municipio</label>
                    <input type="text" class="form-control" name="municipio" value="<?= isset($datosRuta->municipio) ? $datosRuta->municipio : '' ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Actualizar Cliente</button>
            </form>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </body>

        </html>

<?php
    } else {
        echo '<div class="alert alert-danger">No se encontraron datos en la tabla ruta para este cliente.</div>';
    }
} else {
    echo '<div class="alert alert-danger">No se encontraron datos para este cliente.</div>';
}
?>