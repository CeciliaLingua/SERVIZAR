<!-- INICIO -->
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.6/dist/tailwind.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Incluyendo Bootstrap -->
    <link rel="stylesheet" href="bootstrap.css">

    <!-- Custom CSS -->
    <style>
        .product-card {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
        }

        .product-card-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-card-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2; /* Limita la cantidad de líneas visibles */
        }

        .product-card-price {
            font-size: 18px;
            font-weight: bold;
            color: #f65A03;
            margin-top: 10px;
        }

        .product-card:hover {
            transform: scale(1.02);
        }

        .card-actions {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <?php include 'topbar.php'; ?>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <?php include 'navbar.php'; ?>
    <!-- Navbar End -->

<!-- Categories Start -->
<?php

include('conexionbd.php'); // Asegúrate de tener este archivo para la conexión a la base de datos

// Consulta para obtener las categorías
$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);

echo '<div class="container-fluid pt-5">';
echo '<h2 class="section-title position-relative text-uppercase mx-xl-1 mb-0"><span class="pr-3 text-white" style="font-size: 25px; background-color: #8eb4c9;">Categorias</span></h2>';

// Cambiamos el tamaño del contenedor con un ancho del 80% y centrado
echo '<div class="products-container border rounded p-3 mx-auto mb-0" style="width: 100%; height: 150px;">';
if ($result->num_rows > 0) {
    echo '<div class="row px-xl-5 pb-3">';
    // Recorre los resultados
    while ($row = $result->fetch_assoc()) {
        // Imprime el HTML para cada categoría
        echo '<div class="col-lg-3 col-md-4 col-sm-6 pb-1">';
        echo '<a class="text-decoration-none" href="">';
        echo '<div class="cat-item img-zoom d-flex align-items-center mb-4">';
        echo '<div class="overflow-hidden" style="width: 100px; height: 100px;">';
        echo '<img class="img-fluid" src="./img/' . $row['image'] . '" alt="">'; // Cambia 'image' según el nombre de tu columna de imagen
        echo '</div>';
        echo '<div class="flex-fill pl-3">';
        echo '<h6>' . htmlspecialchars($row['categoria']) . '</h6>'; // Cambia 'categoria' según el nombre de tu columna
        echo '<small class="text-body">' . '100 Products</small>'; // Cambia 'product_count' según el nombre de tu columna
        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo 'No categories found.';
}
echo '</div>'; // Cierre del contenedor adicional
echo '</div>';
$conn->close(); // Cierra la conexión a la base de datos
?>
<!-- Categories End -->


<!-- Products Start -->
<?php
    include('conexionbd.php'); // Asegúrate de tener este archivo para la conexión a la base de datos

    // Consulta para obtener los productos
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);
    
    echo '<div class="container-fluid pt-5">';
    echo '<h2 class="section-title position-relative text-uppercase mx-xl-1 mb-0"><span class="pr-3 text-white" style="font-size: 25px; background-color: #8eb4c9;">Para ti</span></h2>';
    echo '<div class="products-container border rounded p-3 mx-xl-1 mb-0">'; // Contenedor adicional con borde y relleno

    if ($result->num_rows > 0) {
        echo '<div class="row px-xl-5 pb-3">';
        
        $counter = 0; // Inicializa un contador

        // Recorre los resultados
        while ($row = $result->fetch_assoc()) { // Recorre todos los productos
            if ($counter < 4) { // Verifica si se han mostrado menos de 4 productos
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
                echo '<a href="ver_servicio.php?id=' . $row['id'] . '" class="btn" style="background-color: #f65A03; color: #fff; border: none;">Ver Más</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                $counter++; // Incrementa el contador
            } else {
                break; // Si ya se mostraron 4 productos, sale del ciclo
            }
        }
        echo '</div>';
    } else {
        echo '<div class="row px-xl-5 pb-3">';
        echo '<p class="text-center w-100">No products found.</p>';
        echo '</div>';
    }

    echo '</div>'; // Cierre del contenedor adicional
    echo '</div>';

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


