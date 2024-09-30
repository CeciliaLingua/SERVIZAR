<!-- NAVBAR -->
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.6/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Incluyendo Bootstrap -->
    <link rel="stylesheet" href="bootstrap.css">

    <style>
    

        .navbar-nav .nav-item img {
            width: 10vw; /* Ancho inicial */
            height: auto; /* Mantiene la proporción */
            flex: 1; /* Permite que los elementos se expandan */
            text-align: center; /* Centra el texto e íconos en cada nav-item */
        }

        @media (max-width: 768px) {
            .navbar-nav .nav-item img {
                width: 15vw; /* Ajusta el ancho para pantallas más pequeñas */
            }
        }

        @media (max-width: 480px) {
            .navbar-nav .nav-item img {
                width: 20vw; /* Ajusta el ancho para pantallas muy pequeñas */
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid mb-30">
        <div class="row px-xl-5">
            <nav class="navbar navbar-expand-lg navbar-light py-3 py-lg-0 px-0 flex-nowrap">
                <div class="navbar-nav mr-auto py-0 flex-nowrap">
                    <a href="carrito.php" class="nav-item nav-link active" style="margin-right: 100px; margin-left: 50px;">
                        <img src="img/carrito.png" alt="Carrito">
                    </a>
                    <a href="usuario.php" class="nav-item nav-link" style="margin-right: 100px;">
                        <img src="img/usuario.png" alt="Usuario">
                    </a>
                    <a href="mis_servicios.php" class="nav-item nav-link" style="margin-right: 100px;">
                        <img src="img/misServicios.png" alt="Mis Servicios">
                    </a>
                    <a href="favoritos.php" class="nav-item nav-link" style="margin-right: 100px;">
                        <img src="img/favoritos.png" alt="Favoritos">
                    </a>
                    <a href="contact.php" class="nav-item nav-link">
                        <img src="img/atencionCliente.png" alt="Atención al Cliente">
                    </a>
                </div>
            </nav>
        </div>
    </div>
</body>

</html>
