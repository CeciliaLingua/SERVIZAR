<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Mis Servicios</title>
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
</head>

<body>

    <!-- Mostrar mensaje de éxito si existe -->
    <?php 
    session_start();
    
    if (isset($_GET['mensaje'])): ?>
        <div class="container alert alert-success">
            <?php echo htmlspecialchars($_GET['mensaje']); ?>
        </div>
    <?php endif; ?>

    <!-- Topbar Start -->
    <?php include 'barra_simple.php'; ?>
    <!-- Topbar End -->

    <div class="container mt-5">
        <h2>Mis Servicios Contratados</h2>
        <table class="max-w-7xl mx-auto table table-bordered">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('conexionbd.php');

                // Verifica si la sesión está iniciada y si 'user_id' está definido
                if (isset($_SESSION['user_id'])) {
                    $id_cliente = $_SESSION['user_id'];

                    // Consulta SQL con JOIN
                    $sql = "
                        SELECT p.image, p.descripcion, p.precio
                        FROM reservas r
                        INNER JOIN detalles_reserva dr ON r.id_reserva = dr.id_reserva
                        INNER JOIN productos p ON dr.id_servicio = p.id
                        WHERE r.id_cliente = ?
                    ";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $id_cliente);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>";
                            // Verifica si el campo 'image' no está vacío y muestra la imagen
                            if (!empty($row['image'])) {
                                echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Imagen' class='img-thumbnail' style='width: 100px; height: auto;'>";
                            } else {
                                echo "No disponible";
                            }
                            echo "</td>";
                            echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                            echo "<td>$" . htmlspecialchars($row['precio']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No se encontraron servicios contratados.</td></tr>";
                    }
                    $stmt->close();
                } else {
                    echo "<tr><td colspan='3'>Por favor, inicie sesión para ver los servicios contratados.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
