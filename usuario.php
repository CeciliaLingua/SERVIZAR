<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Perfil de Usuario</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/LOGO%20CHIQUITO.png" rel="icon" type="image/png">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Stylesheet -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Customized CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-section img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }

        .stars {
            margin: 10px 0;
        }

        .details {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 300px;
            text-align: center;
        }

        .details p {
            margin: 5px 0;
        }

        .services-section {
            margin-top: 30px;
            width: 100%;
        }

        .services-header h3 {
            text-align: center;
        }

        .services-list {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .service-item {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            display: block;
            margin: 20px auto;
        }

        .comments-section {
            margin-top: 30px;
        }

        .comments-section h4 {
            text-align: center;
        }

        .comment {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<?php
include 'conexionbd.php';

session_start(); // Esto debe estar al principio del archivo

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    
    header("Location: iniciar_sesion.php"); // Redirige al inicio de sesión si no está autenticado
    exit();
} else {
    include 'barra_simple.php'; 


$user_id = $_SESSION['user_id']; // Obtiene el ID del usuario desde la sesión

// Consultar datos del usuario
$sql_user = "SELECT nombre FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$stmt_user->close();

// Consultar productos del usuario
$sql_products = "SELECT * FROM productos WHERE userId = ?";
$stmt_products = $conn->prepare($sql_products);
$stmt_products->bind_param("i", $user_id);
$stmt_products->execute();
$result_products = $stmt_products->get_result();
$productos = [];
if ($result_products->num_rows > 0) {
    while ($row = $result_products->fetch_assoc()) {
        $productos[] = $row;
    }
}
}
$stmt_products->close();
$conn->close();



?>
    <div class="container mt-5">
        <!-- Perfil de usuario -->
        <div class="profile-section text-center">
            <img src="https://via.placeholder.com/100" alt="Foto de perfil">
            <h2><?php echo htmlspecialchars($user['nombre']); ?></h2>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="details">
                <p>ID del usuario: <?php echo htmlspecialchars($user_id); ?></p>
                <p>Nombre de usuario: <?php echo htmlspecialchars($user['nombre']); ?></p>
            </div>
            <button class="btn btn-primary mt-3" style="border-radius: 25px;">Editar</button>
        </div>

        <!-- Servicios del usuario -->
        <div class="services-section">
            <div class="services-header">
                <h3>Mis Servicios</h3>
            </div>
            <div class="services-list">
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $producto): ?>
                        <div class="service-item">
    <img src="./img/products/<?php echo htmlspecialchars($producto['image']); ?>" alt="Imagen del servicio" style="width: 100px; height: 100px;">
    <h5><?php echo htmlspecialchars($producto['nombre']); ?></h5>
    <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
    <p>$<?php echo htmlspecialchars($producto['precio']); ?></p>
    <!-- Botón para eliminar el servicio usando GET -->
    <a href="eliminar_producto.php?id=<?php echo $producto['id']; ?>" class="btn btn-danger" style="border-radius: 25px;" onclick="return confirm('¿Estás seguro de que deseas eliminar este servicio?');">Eliminar Servicio</a>
</div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No tienes servicios creados.</p>
                <?php endif; ?>
            </div>
            <a href="crear_producto.php" class="btn btn-primary" style="border-radius: 25px;">Agregar Servicio</a>
        </div>

        <!-- Sección de comentarios -->
        <div class="comments-section">
            <h4>Comentarios</h4>
            <div class="comment">
                <p>Comentario 1...</p>
            </div>
            <div class="comment">
                <p>Comentario 2...</p>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>