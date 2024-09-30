<!-- TOPBAR -->
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

</body>
<?php
//verifica si ya hay una sesión activa:
if (session_status() === PHP_SESSION_NONE) {
    // Inicia la sesión
    session_start();
}
?>

<div class="container-fluid">
    <!-- Barra de navegación con botones -->
    <div class="row align-items-center bg-primary py-1 px-0 ">
        <div class="col-lg-0">
            <!-- Contenedor para la barra de navegación -->
            <a class="btn d-flex align-items-center justify-content-center bg-primary" data-toggle="collapse"
                href="#navbar-vertical" style="height: 50px;">
                <h6 class="text-light m-0"><i class="fa fa-bars mr-2"></i></h6>
                <i class="fa fa-angle-down text-light"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-dark align-items-start p-10 bg-primary "
                id="navbar-vertical" style="height: 250px;  z-index: 999;">
                <div class="navbar-nav" style="height: auto; width: auto;">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="usuario.php" class="nav-item nav-link">Usuario
                        </a>
                        <a>____________________</a>
                    <?php endif; ?>
                    <a href="index.php" class="nav-item nav-link">Inicio</a>
                    <a href="notificaciones.php" class="nav-item nav-link">Notificaciones</a>
                    <a href="carrito.php" class="nav-item nav-link">
                        <img src="img/carrito.png" alt="Carrito" style="width: 20px; height: 20px;">Carrito
                    </a>
                    <a href="favoritos.php" class="nav-item nav-link">Favoritos</a>
                    <a href="mis_servicios.php" class="nav-item nav-link">Mis Servicios</a>
                    <a href="crear_producto.php" class="nav-item nav-link">Crear Servicio</a>
                    <a href="shop1.php" class="nav-item nav-link">Servicios</a>
                </div>
            </nav>
        </div>
        <div class="col-lg-10 d-flex d-flex aligh-items-right justify-content-end">
            <div>
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="navbar-text text-light ml-3">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </span>
                    <a href="logout.php" class="btn-login bg-secondary border-secondary"
                        style="color: white; padding: 8px 10px; border-radius: 25px; display: inline-block; text-align: center;">Cerrar
                        sesión</a>
                <?php else: ?>
                    <a href="iniciar_sesion.php" class="btn-login bg-secondary border-secondary"
                        style="color: white; padding: 8px 10px; border-radius: 25px; display: inline-block; text-align: center;">Iniciar
                        sesión</a>
                    <a href="crear_cuenta.php" class="btn-login bg-secondary border-secondary"
                        style="color: white; padding: 8px 10px; border-radius: 25px; display: inline-block; text-align: center;">Crear
                        usuario</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-primary py-1 px-0 " style="background-image: url('img/background.png'); background-size: cover; 
    background-position: center; background-repeat: no-repeat; height: 250px;">
        <div class="col-12 d-flex flex-column justify-content-center align-items-center">
            <div class="bg-primary text-center" style="border-radius: 50px; padding: 10px 40px; margin-bottom: -150px;">
                <h1 class="text-light">Servizar</h1> <!-- Texto centrado -->
            </div>
        </div>
        <div class="col-lg-4 col-6 text-left" style="  padding: 20px;  position: relative;  left: -10px;">
            <form action="">
                <div class="input-group bg-white border-primary"  style="border: 10px solid #0b4d71 ; border-radius: 50px; background-color: white;">
                    <input type="text" class="form-control" placeholder="Buscar servicios, productos y más..." >
                        <span class="input-group-text bg-secondary text-white " style="border-radius: 50px;">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>