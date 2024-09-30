<?php
session_start();
include 'conexionbd.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$total = $_POST['total'];
$fecha_reserva = date('Y-m-d'); // Fecha actual

// Iniciar una transacción para asegurar consistencia en la base de datos
$conn->begin_transaction();

try {
    // 1. Insertar una nueva reserva
    $sql_reserva = "INSERT INTO reservas (id_cliente, costo_total, fecha_reserva) VALUES (?, ?, ?)";
    $stmt_reserva = $conn->prepare($sql_reserva);
    $stmt_reserva->bind_param("ids", $user_id, $total, $fecha_reserva);
    $stmt_reserva->execute();
    $id_reserva = $stmt_reserva->insert_id;

    // 2. Obtener los productos del carrito del usuario
    $sql_carrito = "SELECT id_servicio FROM detalle_carrito WHERE id_carrito = (SELECT id_carrito FROM carrito WHERE id_usuario = ?)";
    $stmt_carrito = $conn->prepare($sql_carrito);
    $stmt_carrito->bind_param("i", $user_id);
    $stmt_carrito->execute();
    $result_carrito = $stmt_carrito->get_result();

    // 3. Insertar cada producto en el detalle de la reserva
    while ($row = $result_carrito->fetch_assoc()) {
        $id_servicio = $row['id_servicio'];
        $cantidad = 1; // Cantidad fija de 1 por ahora

        $sql_detalle_reserva = "INSERT INTO detalles_reserva (id_reserva, id_servicio, cantidad) VALUES (?, ?, ?)";
        $stmt_detalle_reserva = $conn->prepare($sql_detalle_reserva);
        $stmt_detalle_reserva->bind_param("iii", $id_reserva, $id_servicio, $cantidad);
        $stmt_detalle_reserva->execute();
    }

    // 4. Limpiar el carrito del usuario
    $sql_limpiar_carrito = "DELETE FROM detalle_carrito WHERE id_carrito = (SELECT id_carrito FROM carrito WHERE id_usuario = ?)";
    $stmt_limpiar_carrito = $conn->prepare($sql_limpiar_carrito);
    $stmt_limpiar_carrito->bind_param("i", $user_id);
    $stmt_limpiar_carrito->execute();

    // Confirmar la transacción
    $conn->commit();

    // Redirigir con un mensaje de éxito
    header("Location: carrito.php?mensaje=Reserva confirmada con éxito");

} catch (Exception $e) {
    // En caso de error, deshacer la transacción
    $conn->rollback();
    echo "Error al procesar la reserva: " . $e->getMessage();
}

$conn->close();
?>
