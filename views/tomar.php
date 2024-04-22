<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "bodega3");

// Verificar la conexión
if (!$conexion) {
    die("La conexión falló: " . mysqli_connect_error());
}

// Obtener la lista de productos
$sql_productos = "SELECT idProducto, nombre, precio FROM producto";
$resultado_productos = mysqli_query($conexion, $sql_productos);

// Obtener la lista de clientes
$sql_clientes = "SELECT idCliente, nombre FROM cliente";
$resultado_clientes = mysqli_query($conexion, $sql_clientes);

// Obtener la lista de rutas
$sql_rutas = "SELECT idRuta, direccion, municipio FROM ruta";
$resultado_rutas = mysqli_query($conexion, $sql_rutas);

// Iniciar o reanudar la sesión
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Procesar la acción de agregar al carrito
if (isset($_POST['agregar'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Obtener información del producto
    $sql_info_producto = "SELECT nombre, precio FROM producto WHERE idProducto = $producto_id";
    $resultado_info_producto = mysqli_query($conexion, $sql_info_producto);
    $info_producto = mysqli_fetch_assoc($resultado_info_producto);

    // Agregar el producto al carrito
    $_SESSION['carrito'][] = array(
        'idProducto' => $producto_id,
        'nombre' => $info_producto['nombre'],
        'precio' => $info_producto['precio'],
        'cantidad' => $cantidad
    );
}

if (isset($_POST['limpiar_carrito'])) {
    // Limpiar el carrito de la sesión
    unset($_SESSION['carrito']);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <button><a href="../views/pedidos.php">atras</a></button>
    <section style="margin: 30px;">
        <div class="container mb-3">
            <form class="form-container" method="post" action="">
                <h2 class="form-title">Productos Disponibles</h2>
                <div class="form-group">
                    <select class="form-control" name="producto_id">
                        <?php while ($producto = mysqli_fetch_assoc($resultado_productos)) : ?>
                            <option value="<?php echo $producto['idProducto']; ?>">
                                <?php echo $producto['nombre'] . ' - $' . $producto['precio']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="cantidad">Cantidad:</label>
                        <input class="form-control" type="number" name="cantidad" value="1" min="1">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="agregar">Agregar al Carrito</button>
            </form>

            <h2>Carrito de Compras</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;

                        if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
                            foreach ($_SESSION['carrito'] as $item) :
                                $subtotal = $item['precio'] * $item['cantidad'];
                                $total += $subtotal;
                        ?>
                                <tr>
                                    <td><?php echo $item['nombre']; ?></td>
                                    <td>$<?php echo $item['precio']; ?></td>
                                    <td><?php echo $item['cantidad']; ?></td>
                                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                                </tr>
                        <?php
                            endforeach;
                        } else {
                            echo "<tr><td colspan='4'>No hay productos en el carrito.</td></tr>";
                        }
                        ?>
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td>$<?php echo number_format($total, 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2>Información del Cliente y Ruta</h2>
            <form method="post" action="../dist/procesar_compra.php">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cliente">Seleccionar Cliente:</label>
                        <select class="form-control" name="cliente">
                            <?php while ($cliente = mysqli_fetch_assoc($resultado_clientes)) : ?>
                                <option value="<?php echo $cliente['idCliente']; ?>">
                                    <?php echo $cliente['nombre']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ruta">Seleccionar Ruta:</label>
                        <select class="form-control" name="ruta">
                            <?php while ($ruta = mysqli_fetch_assoc($resultado_rutas)) : ?>
                                <option value="<?php echo $ruta['idRuta']; ?>">
                                    <?php echo $ruta['direccion'] . ', ' . $ruta['municipio']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="procesar_compra">Procesar Compra</button>
            </form>

            <!-- Formulario para limpiar el carrito -->
            <form method="post" action="">
                <input type="submit" class="btn btn-danger" name="limpiar_carrito" value="Limpiar Carrito">
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>