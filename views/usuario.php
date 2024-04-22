<?php
// Incluye el archivo de conexión a la base de datos
include "../config/db.php";
?>

<body>
    <?php
    include '../menu/nav.php';
    ?>
    <script>
        function eliminar() {
            var respuesta = confirm("Estas seguro que quieres Eliminar");
            return respuesta

        }
    </script>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="POST">
            <?php
            include "../config/db.php";

            include "../dist/eliminar_persona.php";
            ?>
            <h4>Registro de Usuario</h4>
            <?php
            include "../config/db.php";

            include "../controllers/registro_persona.php";
            ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Usuario</label>
                    <input type="text" class="form-control" name="usuario">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">password</label>
                    <input type="text" class="form-control" name="password">
                </div>


                <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
            </form>
            <div class=" col-8 p-4">
                <h2>Panel User</h2>
                <table class="table" table-primary>
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">IdUsuario</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Password</th>
                            <th></th>
                            <th></th>
                        </tr>

                    <tbody>
                        <?php
                        $sql = $conexion->query("SELECT * FROM persona");

                        if ($sql) {
                            while ($datos = $sql->fetch_object()) {

                        ?>
                                <tr>
                                    <th scope="row"><?= $datos->idUsuario ?></th>
                                    <td><?= $datos->usuario ?></td>
                                    <td><?= $datos->password ?></td>
                                    <td><a href="../views/modificar_persona.php?idUsuario=<?= $datos->idUsuario ?>">Editar</a></td>
                                    <td><a onclick="return eliminar()" href="../views/usuario.php?idUsuario=<?= $datos->idUsuario ?>">Borrar</a></td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>


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