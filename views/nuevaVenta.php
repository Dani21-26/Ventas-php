<?php
// Incluye el archivo de conexión a la base de datos
include "../config/db.php";
?>

<body>
    <?php
    include '../menu/nav.php';
    ?>
    <section id="container">
        <div>
            <h1>nueva venta</h1>
        </div>
        <div class="datos_clientes">
            <div action_cliente></div>
            <h4>Datos del Cliente</h4>
            <a href="#" class="btn_new btn_cliente">Nuevo cliente</a>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="idCliente" class="form-label">idCliente</label>
                                <input type="text" class="form-control" name="idCliente" id="idCliente" disabled required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="fecha" id="nombre" disabled required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" disabled required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" disabled required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary mt-2" name="btnregistrar" value="ok">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container">
                    <div class="row">
                        <div class="datos_venta col-md-12">
                            <h4>Datos de Venta</h4>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="">Vendedor</label>
                                        <p>Marcelo</p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div id="acciones_venta">
                                            <label for="Acciones" class="form-label">Acciones</label>
                                            <a href="#" class="btn btn-primary" id="btn_anular_venta">Anular</a>
                                            <a href="#" class="btn btn-primary" id="btn_procesar_venta">Procesar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <table class="table table-primary">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Descripcio</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">precio</th>
                        <th scope="col">PrecioTotal</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
    </section>
</body>