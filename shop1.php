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


<!-- Products Start -->
<?php
    include('conexionbd.php'); // Asegúrate de tener este archivo para la conexión a la base de datos

    // Consulta para obtener los productos
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Agregamos el margen superior con style="margin-top: 30px;"
        echo '<div class="row px-xl-5 pb-3" style="margin-top: 30px;">'; 

        // Recorre los resultados
        while ($row = $result->fetch_assoc()) { // Recorre todos los productos
            // Imprime el HTML para cada producto
            echo '<div class="col-lg-3 col-md-4 col-sm-6 pb-4">';
            echo '<div class="product-card" style="background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 15px; height: 400px; display: flex; flex-direction: column; justify-content: space-between;">'; // Estilo en línea para fondo blanco, bordes redondeados y tamaño fijo

            // Ajusta el tamaño máximo de las imágenes y asegúrate de que se ajusten sin distorsión
            echo '<div style="width: 100%; height: 100%; overflow: hidden; display: flex; align-items: center; justify-content: center;">';
            echo '<img src="./img/products/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['nombre']) . '" style="width: 100%; height: auto; object-fit: cover;">';
            echo '</div>';

            echo '<div class="product-card-body">';
            echo '<h5 class="product-card-title">' . htmlspecialchars($row['nombre']) . '</h5>';
            echo '<p class="product-card-description">' . htmlspecialchars($row['descripcion']) . '</p>';
            echo '<p class="product-card-price">$' . htmlspecialchars($row['precio']) . '</p>';
            echo '<div class="card-actions">';
            // Botón "Ver más" que lleva a ver_servicio.php con el ID del producto
            echo '<a href="ver_servicio.php?id=' . $row['id'] . '" class="btn" style=" border-radius: 25px; background-color: #f65A03; color: #fff; border: none;">Ver Más</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="row px-xl-5 pb-3">';
        echo '<p class="text-center w-100">No products found.</p>';
        echo '</div>';
    }

    $conn->close(); // Cierra la conexión a la base de datos
?>
<!-- Products End -->



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
