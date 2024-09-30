<!--CARRITO-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Carrito de Compras</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/LOGO%20CHIQUITO.png" rel="icon" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<?php

$error_message = "";
$exito_message = ""; // Inicializa la variable para el mensaje de éxito
session_start();
// Obtiene el ID del usuario desde la sesión
$user_id = $_SESSION['user_id'];

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciar_sesion.php"); // Redirige al usuario a la página de inicio de sesión
    exit();
}

include('conexionbd.php'); // Incluye la conexión a la base de datos

// Obtiene el ID del carrito del usuario
$sql = "SELECT id_carrito FROM carrito WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $carrito = $result->fetch_assoc();
    $carrito_id = $carrito['id_carrito'];
} else {
    // Si no existe un carrito para el usuario, crea uno nuevo
    $sql = "INSERT INTO carrito (id_usuario, costo_total) VALUES (?, 0.00)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $carrito_id = $stmt->insert_id;
}

// Obtiene los detalles del carrito
$sql = "SELECT dc.id_detalle, p.nombre, p.image, dc.cantidad, p.precio
        FROM detalle_carrito dc
        JOIN productos p ON dc.id_servicio = p.id
        WHERE dc.id_carrito = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $carrito_id);
$stmt->execute();
$result = $stmt->get_result();

// Calcula el total del carrito
$total = 0;
?>

<!-- Topbar Start -->
<?php include 'barra_simple.php'; ?>
    <!-- Topbar End -->

    <div class="container my-5">
        <h2>Tu Carrito</h2>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <?php if (!empty($exito_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($exito_message); ?></div>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): 
                        $subtotal = $row['precio'] * $row['cantidad'];
                        $total += $subtotal;
                        
                    ?>
                    
                        <tr>
                            <td><img src="./img/products/<?php echo htmlspecialchars($row['image']); ?>" alt="Imagen del Producto" style="width: 100px; height: auto;"></td>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                            <td>$<?php echo htmlspecialchars($row['precio']); ?></td>
                            <td>
                                <a href="remove_from_cart.php?id=<?php echo htmlspecialchars($row['id_detalle']); ?>" class="btn btn-danger " style="border-radius: 25px;">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h4>Total: $<?php echo number_format($total, 2); ?> </h4>
            <form action="procesar_reserva.php" method="POST">
    <input type="hidden" name="total" value="<?php echo $total; ?>">
    <button type="submit" class="btn btn-success" style="border-radius: 25px;">Confirmar Reserva</button>
</form>
        <?php else: ?>
            <p>Tu carrito está vacío.</p>
        <?php endif; ?>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close(); // Cierra la conexión a la base de datos
?>
