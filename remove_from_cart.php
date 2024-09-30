<?php
session_start(); // Inicia la sesión para obtener el ID del usuario

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciar_sesion.php"); // Redirige al inicio de sesión si no está autenticado
    exit();
}

include('conexionbd.php'); // Incluye la conexión a la base de datos

// Obtiene el ID del detalle del carrito desde la URL
$id_detalle = isset($_GET['id']) ? $_GET['id'] : 0;
$user_id = $_SESSION['user_id']; // Obtiene el ID del usuario desde la sesión

// Verifica si el ID del detalle es válido
if ($id_detalle > 0) {
    // Obtiene el ID del carrito del usuario
    $sql = "SELECT id_carrito FROM carrito WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $carrito = $result->fetch_assoc();
        $carrito_id = $carrito['id_carrito'];

        // Elimina el detalle del carrito
        $sql = "DELETE FROM detalle_carrito WHERE id_detalle = ? AND id_carrito = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_detalle, $carrito_id);
        $stmt->execute();

        // Actualiza el costo total del carrito
        $sql = "UPDATE carrito SET costo_total = (SELECT SUM(p.precio * dc.cantidad) FROM detalle_carrito dc JOIN productos p ON dc.id_servicio = p.id WHERE dc.id_carrito = ?) WHERE id_carrito = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $carrito_id, $carrito_id);
        $stmt->execute();
    }
}

$conn->close(); // Cierra la conexión a la base de datos

// Redirige al usuario de vuelta a la página del carrito
header("Location: carrito.php");
exit();
?>