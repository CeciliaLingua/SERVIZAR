<!--VER SERVICIO-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Servizar</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/LOGO%20CHIQUITO.png" rel="icon"   type="image/png"> 

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
<?php $page = 'ver_servicio'; // Define la página actual?>
    <!-- Barra arriba -->
    <?php include 'barra_simple.php'; ?>
    <!-- Barra arriba -->

<?php

include('conexionbd.php'); // Incluye la conexión a la base de datos

// Verifica si hay un mensaje de éxito en la URL
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="alert alert-success">Producto añadido correctamente al carrito.</div>';
    } elseif (isset($_GET['success']) && $_GET['success'] == 2) {
    echo '<div class="alert alert-success">Reserva realizada con éxito.</div>';
}


// Obtener el ID del servicio desde la URL
$servicio_id = isset($_GET['id']) ? $_GET['id'] : 1; // Por defecto ID = 1 si no hay ID en la URL

// Consulta para obtener los detalles del servicio
$sql = "SELECT * FROM productos WHERE id = $servicio_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>

    <div class="service-container">
        <!-- Imagen del servicio a la izquierda -->
        <div class="service-image">
            <img src="./img/products/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
        </div>

        <!-- Información del servicio a la derecha -->
        <div class="service-details">
            <h1><?php echo htmlspecialchars($row['nombre']); ?></h1>

            <!-- Enlace al perfil del vendedor -->
            <a href="seller-profile.php?id=<?php echo $row['id']; ?>" class="seller-profile">Ir al perfil del vendedor</a>

            <!-- Descripción del servicio -->
            <p><?php echo !empty($row['descripcion']) ? htmlspecialchars($row['descripcion']) : 'No se encontró descripción'; ?></p>

            <!-- Precio del servicio -->
            <p class="price">$<?php echo htmlspecialchars($row['precio']); ?></p>

            <!-- Botones de acción -->
            <div class="service-actions">
                <!-- Botón de reservar -->
                <a href="reservar.php?id=<?php echo $row['id']; ?>" class="btn bg-secondary "style="margin-right: 20px; border-radius: 25px;">Reservar</a>
                
                <!-- Botón de favoritos con imagen de corazón -->
                <span class="icon"style="margin-right: 20px; ">
                    <a href="agregar_favorito.php?id=<?php echo $row['id']; ?>">
                        <img src="img/favoritos.png" alt="Añadir a favoritos" width="30" height="30">
                    </a>
                </span>

                <!-- Botón de carrito con imagen de carrito -->
                <span class="icon"style="margin-right: 20px;">
                    <a href="agregar_carrito.php?id=<?php echo $row['id']; ?>">
                        <img src="img/carrito.png" alt="Añadir al carrito" width="30" height="30">
                    </a>
                </span>
            </div>
        </div>
    </div>

    <?php
} else {
    echo "<p>No se encontró el servicio.</p>";
}

$conn->close(); // Cerrar la conexión a la base de datos
?>
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
