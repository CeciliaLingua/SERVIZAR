<?php
session_start(); // Inicia la sesión para obtener el ID del usuario
$error_message = "";
$exito_message = ""; // Inicializa la variable para el mensaje de éxito

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciar_sesion.php"); // Redirige al inicio de sesión si no está autenticado
    exit();
}

include('conexionbd.php'); // Incluye la conexión a la base de datos

// Obtiene el ID del servicio desde la URL
$servicio_id = isset($_GET['id']) ? $_GET['id'] : 0;
$user_id = $_SESSION['user_id']; // Obtiene el ID del usuario desde la sesión

// Obtiene el ID del carrito del usuario
$sql = "SELECT id_carrito FROM carrito WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $carrito = $result->fetch_assoc();
    $carrito_id = $carrito['id_carrito'];
    $exito_message = "Se agregó al carrito correctamente.";
} else {
    // Si no existe un carrito para el usuario, crea uno nuevo
    $sql = "INSERT INTO carrito (id_usuario, costo_total) VALUES (?, 0.00)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $carrito_id = $stmt->insert_id;
}

// Verifica si el servicio ya está en el carrito
$sql = "SELECT * FROM detalle_carrito WHERE id_carrito = ? AND id_servicio = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $carrito_id, $servicio_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si el servicio ya está en el carrito, incrementa la cantidad
    $sql = "UPDATE detalle_carrito SET cantidad = cantidad + 1 WHERE id_carrito = ? AND id_servicio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $carrito_id, $servicio_id);
    $stmt->execute();
} else {
    // Si el servicio no está en el carrito, agrégalo con cantidad 1
    $sql = "INSERT INTO detalle_carrito (id_carrito, id_servicio, cantidad) VALUES (?, ?, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $carrito_id, $servicio_id);
    $stmt->execute();
}

// Actualiza el costo total del carrito
$sql = "UPDATE carrito SET costo_total = (SELECT SUM(p.precio * dc.cantidad) FROM detalle_carrito dc JOIN productos p ON dc.id_servicio = p.id WHERE dc.id_carrito = ?) WHERE id_carrito = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $carrito_id, $carrito_id);
$stmt->execute();

$conn->close(); // Cierra la conexión a la base de datos

// Redirige al usuario de vuelta a la página de servicio con un mensaje de éxito
header("Location: ver_servicio.php?id=" . $servicio_id . "&success=1");
exit();
?>
