<?php
// Incluye el archivo de conexión a la base de datos
include "../config/db.php";
?>

<body>
    <?php
    include '../menu/nav.php';
    ?>
    <script>
        function eliminar(){
            var respuesta=confirm("Estas seguro que quieres Eliminar");
            return respuesta

        }
    </script>
    <div class="container-fluid row">
        <h1>Lista de Usuarios</h1>
        <form class="col-4 p-3" method="POST">
            <?php
            include "../config/db.php";

            include "../dist/eliminar_cliente.php";
            ?>
            <h4>Registro de clientes</h4>
            <?php
            include "../config/db.php";
            
            include "../controllers/registro_cliente.php";
            ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">nombre Del Negocio</label>
                <input type="text" class="form-control" name="nombreTienda" id="nombreTienda">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="direccion" id="direccion">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Municipio</label>
                <input type="text" class="form-control" name="municipio" id="municipio">
            </div>
    
            <button type="submit" class="btn btn-primary" name="btnregistrarCliente" value="ok">Registrar</button>
        </form>
        <div class=" col-8 p-4">
            <h2>Panel de Cliente</h2>
            <table class="table" table-primary>
                <thead class="bg-info">
                    <tr>
                        <th scope="col">IdCliente</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Nombre del Negocio</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Municipio</th>
                        <th></th>
                        <th></th>
                    </tr>
                
                <tbody>
                    <?php
                    $sql = $conexion->query("SELECT * FROM cliente");

                    if ($sql) {
                        while ($datos = $sql->fetch_object()) {
                            ?>
                            <tr>
                                <th scope="row"><?= $datos->idCliente ?></th>
                                <td><?= $datos->nombre ?></td>
                                <td><?= $datos->nombreTienda ?></td>
                                <td><?= $datos->telefono ?></td>
                                <?php
                                // Obtener datos de la tabla 'ruta' usando el idCliente
                                $idCliente = $datos->idCliente;
                                $queryRuta = $conexion->query("SELECT direccion, municipio FROM ruta WHERE idCliente = '$idCliente'");
                                if ($queryRuta) {
                                    $ruta = $queryRuta->fetch_object();
                                    ?>
                                    <td><?= isset($ruta->direccion) ? $ruta->direccion : 'No disponible' ?></td>
                                    <td><?= isset($ruta->municipio) ? $ruta->municipio : 'No disponible' ?></td>
                                    <?php
                                } else {
                                    ?>
                                    <td colspan="2">No se encontraron datos en la tabla ruta.</td>
                                    <?php
                                }
                                ?>
                                <td><a href="../views/modificar_cliente.php?idCliente=<?= $datos->idCliente ?>">Editar</a></td>
                                <td><a onclick="return eliminar()" href="../views/cliente.php?idCliente=<?= $datos->idCliente ?>">Borrar</a></td>
                            </tr>
                            <?php
                        } // Cierre del while
                    } else {
                        // Si no se obtienen resultados
                        echo "<tr><td colspan='6'>No se encontraron datos.</td></tr>";
                    } // Cierre del if ($sql)
                    ?>

                    
                    
                </thead>

                </tbody>
            </table>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

        <script>
    function toggleMenu() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("active");
    }

    document.getElementById('logoutButton').addEventListener('click', function() {
        window.location.href = '../index.html';
    });
</script>


    
</body>
</html>