<?php
// Incluye el archivo de conexión a la base de datos
include "../config/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Usuarios</title>
</head>

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

            include "../dist/eliminar_factura.php";
            ?>
            <h4>Registro de factura</h4>
            <?php
            include "../config/db.php";

            include "../controllers/registro_factura.php";
            ?>
            <div class="container-fluid row">
                <form class="col-12 p-3 form-inline" method="POST">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="idFactura" class="form-label">ID Factura</label>
                            <input type="text" class="form-control" name="idFactura" id="idFactura">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="fecha">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="idCliente" class="form-label">ID Cliente</label>
                            <input type="text" class="form-control" name="idCliente" id="idCliente">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control total" name="total" id="total" readonly>
                        </div>
                    </div>
                    <div class="col-md-12"></div> <!-- Espacio adicional para separar visualmente -->

                    <div class="col-md-3">
                        <div id="productos">
                            <div class="producto row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idProducto" class="form-label">ID Producto</label>
                                        <input type="text" class="form-control idProducto" name="idProducto[]" id="idProducto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="text" class="form-control cantidad" name="cantidad[]" id="cantidad" oninput="calcularSubtotal(this)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio" class="form-label">Precio</label>
                                        <input type="text" class="form-control precio" name="precio[]" id="precio" oninput="calcularSubtotal(this)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subtotal" class="form-label">Subtotal</label>
                                        <input type="text" class="form-control subtotal" name="subtotal[]" id="subtotal" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group text-center">
                            <button type="button" class="btn btn-success mt-2" onclick="agregarProducto()">Agregar Producto</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary mt-2" name="btnregistrar" value="ok">Registrar Pedido</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class=" col-8 p-4">
                <h2>Panel User</h2>
                <table class="table" table-primary>
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">idFactura</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">idCliente</th>
                            <th scope="col">Total</th>
                            <th scope="col">cantidad</th>
                            <th scope="col">idProducto</th>
                            <th></th>
                            <th></th>
                        </tr>

                    <tbody>
                        <?php
                        $sql = $conexion->query("SELECT * FROM producto");

                        if ($sql) {
                            while ($datos = $sql->fetch_object()) {

                        ?>
                                <tr>
                                    <th scope="row"><?= $datos->idFacruta ?></th>
                                    <td><?= $datos->fecha ?></td>
                                    <td><?= $datos->idCliente ?></td>
                                    <td><?= $datos->total ?></td>
                                    <td><?= $datos->Cantidad ?></td>
                                    <td><?= $datos->idProducto ?></td>
                                    <td><a href="../views/modificar_factura.php?idFactura=<?= $datos->idFactura ?>">Editar</a></td>
                                    <td><a onclick="return eliminar()" href="../views/factura.php?idFactura=<?= $datos->idFactura ?>">Borrar</a></td>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">

    </script>
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