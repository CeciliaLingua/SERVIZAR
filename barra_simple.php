<!-- BARRA SIMPLE -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Servizar</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/LOGO%20CHIQUITO.png" rel="icon" type="image/png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Incluyendo Bootstrap -->
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>

<?php
//verifica si ya hay una sesión activa:
if (session_status() === PHP_SESSION_NONE) {
    // Inicia la sesión
    session_start();
}
?>
<?php

if (isset($page) && ($page == 'iniciar_sesion' || $page == 'crear_cuenta')): ?>
    <div class="container-fluid">
        <!-- Barra de navegación con botones -->
        <div class="row align-items-center bg-primary py-1 px-0 ">
            <div class="col-lg-0 d-none d-lg-block">
                <!-- Contenedor para la barra de navegación -->
                <a class="btn d-flex align-items-center justify-content-center bg-primary" data-toggle="collapse"
                href="#navbar-vertical" style="height: 50px;">
                    <h6 class="text-light m-0">
                        <i class="fa fa-bars mr-2"></i>
                    </h6>
                        <i class="fa fa-angle-down text-light"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-dark align-items-start p-10 bg-primary "
                id="navbar-vertical" style="height: 250px;  z-index: 999;">
                    <div class="navbar-nav" style="height: 100vh; width: auto;">
                        <?php if (isset($_SESSION['username'])): ?>
                            <a href="usuario.php" class="nav-item nav-link">Usuario</a>
                        <?php endif; ?>
                        <a href="index.php" class="nav-item nav-link">Inicio</a>
                        <a href="notificaciones.php" class="nav-item nav-link">Notificaciones</a>
                        <a href="carrito.php" class="nav-item nav-link">Carrito</a>
                        <a href="favoritos.php" class="nav-item nav-link">Favoritos</a>
                        <a href="mis_servicios.php" class="nav-item nav-link">Mis Servicios</a>
                        <!-- Nueva opción añadida -->
                        <a href="crear_producto.php" class="nav-item nav-link">Crear Servicio</a>
                        <a href="shop1.php" class="nav-item nav-link">Servicios</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-10 d-flex align-items-right justify-content-end">
                <!-- Botones para Iniciar sesión y Crear cuenta -->
                <div>
                    <?php if ($page == 'iniciar_sesion'): ?>
                        <a href="crear_cuenta.php" class="btn-login bg-secondary border-secondary" style="color: white; padding: 8px 10px; border-radius: 25px; display: inline-block; text-align: center;">Crear Cuenta</a>
                    <?php elseif ($page == 'crear_cuenta'): ?>
                        <a href="iniciar_sesion.php" class="btn-login bg-secondary border-secondary" style="color: white; padding: 8px 10px; border-radius: 25px; display: inline-block; text-align: center;">Iniciar sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
<?php else: ?>

<!-- Barra de navegación con botones y barra de búsqueda -->
<div class="container-fluid" >
    <div class="row align-items-center bg-primary py-1 px-0" >
        <div class="col-lg-0 d-none d-lg-block" >
            <!-- Contenedor para la barra de navegación -->
            <a class="btn d-flex align-items-center justify-content-center bg-primary" data-toggle="collapse"
                href="#navbar-vertical" style="height: 50px;">
                <h6 class="text-light m-0"><i class="fa fa-bars mr-2"></i></h6>
                <i class="fa fa-angle-down text-light"></i>
            </a>

            <nav class="collapse position-absolute navbar navbar-vertical navbar-dark align-items-start p-3 bg-primary"
                id="navbar-vertical" style="height: 250px; z-index: 999;">
                <div class="navbar-nav" style="height: 100vh; width: auto;">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="usuario.php" class="nav-item nav-link">Usuario</a>
                    <?php endif; ?> 
                    <a href="index.php" class="nav-item nav-link">Inicio</a>
                    <a href="notificaciones.php" class="nav-item nav-link">Notificaciones</a>
                    <a href="favoritos.php" class="nav-item nav-link">Favoritos</a>
                    <a href="mis_servicios.php" class="nav-item nav-link">Mis Servicios</a>
                    <a href="carrito.php" class="nav-item nav-link">Carrito</a>
                    <!-- Nueva opción añadida -->
                    <a href="crear_producto.php" class="nav-item nav-link">Crear Servicio</a>
                    <a href="shop1.php" class="nav-item nav-link">Servicios</a>
                </div>
            </nav>
        </div>

        <!-- Barra de búsqueda centrada -->
        <div class="col-lg-6 mx-auto text-center">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control text-primary bg-light" style="border-radius: 25px;" placeholder="Buscar servicios, productos y más...">
                    <div class="input-group-append">
                        <span class="input-group-text text-secondary bg-secondary" style="border-radius: 25px;">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endif; 
?>
</body>

</html>
