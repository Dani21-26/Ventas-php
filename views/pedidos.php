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
                                <button><a href="../views/pedidos.php">atras</a></button>
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

        <div id="content" class="bg-grey w-100">

            <section class="bg-light py-3">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-9 col-md-8">
                            <h1 class="font-weight-bold mb-0">Bienvenida Juleimy</h1>
                        </div>



                        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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