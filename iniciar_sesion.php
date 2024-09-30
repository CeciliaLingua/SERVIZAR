<!-- INICIAR SESION -->


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

    <!-- Incluyendo Bootstrap -->
    <link rel="stylesheet" href="bootstrap.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<?php $page = 'iniciar_sesion'; // Define la página actual ?>
    <!-- Barra arriba -->
    <?php include 'barra_simple.php'; ?>
    <!-- Barra arriba -->

    <div class="container-fluid" >
    <div class="row align-items-center bg-light py-3 px-xl-5 " style="background-image: url('img/iniciar_sesionlogo.png'); background-size: cover; 
    background-position: center; background-repeat: no-repeat; height: 350px;">
    </div>
        <div class="row bg-blue py-1 px-0 d-none d-lg-flex" >
            
            <div class="col-lg-12 d-none d-lg-block">
                <div class="row justify-content-center">
                    <div class="col-lg-2 bg-secondary border-secondary mx-xl-10 mt-3 mb-0" style="border-radius: 25px;">
                        <div class="bienvenido-container justify-content-center text-center">
                            <h2 style="color: white;">Bienvenido</h2> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-5 mb-5" style="background:#cfd8df; border-radius: 25px;">
                    <form action="tu_proceso_de_login.php" method="POST">
                        <div class="username mb-2">
                            <input type="email" name="email" placeholder="Email" class="custom-form-control mt-3 mb-3" required>
                        </div>
                        <div class="contraseña mb-2">
                            <input type="password" name="contraseña" placeholder="Contraseña" class="custom-form-control mb-3" required>
                        </div>
                        <div class="options">
                            <div class="checkbox-container">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">Recuérdame</label>
                            </div>
                            <a href="#" class="forgot-contraseña">¿Olvidaste tu contraseña?</a>
                        </div>
                        <button type="submit" class="btn-login bg-secondary border-secondary mt-5 mb-5" style="color: white; padding: 8px 150px; width: 100%; border-radius: 25px;">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>  
    </div> 

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>