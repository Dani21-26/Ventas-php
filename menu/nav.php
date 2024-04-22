<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->


    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,700&display=swap" rel="stylesheet">

    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://c0.klipartz.com/pngpicture/678/280/gratis-png-computadora-iconos-logistica-almacen-negocio-bodega.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/menu.css">
    <title>Panel</title>
</head>

<body>
    <header>

        <nav class="sidebar" id="sidebar">
            <h3>Menú de Opciones</h3>
            <ul>
                <li><a href="../views/usuario.php">Usuario</a></li>
                <li><a href="../views/producto.php">Producto</a></li>
                <li><a href="../views/cliente.php">Clientes</a></li>
                <li><a href="../views/proveedor.php">Proveedores</a></li>
                <ul class="menu">
                    <li class="menu-item">
                        <a href="../views/venta.php">Ventas</a>
                        <ul class="submenu">
                            <li><a href="../views/tomar.php">Tomar Pedido</a></li>
                            <li><a href="../views/cliente.php">Clientes</a></li>
                        </ul>
                    </li>
                </ul>



            </ul>
        </nav>
    </header>
    <div class="w-100">

        <!-- Navbar -->

        <div class="w-100">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="form-inline position-relative d-inline-block my-2">
                            <input class="form-control" type="search" placeholder="Buscar" aria-label="Buscar">
                            <button class="btn position-absolute btn-search" type="submit"><i class="icon ion-md-search"></i></button>
                        </form>
                        <div class="position-relative ml-5">
                            <label for="check">
                                <img src="../img/icono.png" width="50" height="50" onclick="toggleMenu()" alt="Menú">
                                <button><a href="./home.php">atras</a></button>
                            </label>
                            <input type="checkbox" id="check" class="position-absolute" style="top: 0; left: 0; opacity: 0;">
                        </div>


                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ☰
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Mi perfil</a>
                                    <a class="dropdown-item" href="#">Suscripciones</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" id="logoutButton">Cerrar sesión</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>