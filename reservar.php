<?php
session_start(); // Si estás usando sesiones para el cliente

include 'conexionbd.php'; // Conexión a la base de datos

// Definir una variable para los mensajes de error
$error_message = "";

// Obtener el ID del usuario desde la sesión
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Verificar si el usuario está autenticado
if (!$user_id) {
    $error_message = "Debe iniciar sesión para reservar.";
    include 'error.php';
    exit();
}

// Comprobar si el user_id existe en la tabla users
$sql_check_user = "SELECT id FROM users WHERE id = $user_id";
$result_check_user = $conn->query($sql_check_user);

if ($result_check_user->num_rows === 0) {
    $error_message = "El usuario no existe en la base de datos.";
    include 'error.php';
    exit();
}

// Obtener el ID del servicio desde la URL o establecer un valor predeterminado
$servicio_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

if ($servicio_id && $user_id) {
    // Obtener la información del servicio para obtener el costo total
    $sql_servicio = "SELECT precio FROM productos WHERE id = $servicio_id";
    $result_servicio = $conn->query($sql_servicio);
    
    if ($result_servicio->num_rows > 0) {
        $row_servicio = $result_servicio->fetch_assoc();
        $costo_total = $row_servicio['precio'];
        
        // Insertar la reserva en la base de datos
        $fecha_reserva = date('Y-m-d'); // Fecha actual en formato YYYY-MM-DD

        $sql_reserva = "INSERT INTO reservas (fecha_reserva, id_cliente, costo_total) 
                        VALUES ('$fecha_reserva', $user_id, $costo_total)";
        
        if ($conn->query($sql_reserva) === TRUE) {
            header("Location: ver_servicio.php?id=$servicio_id&success=2");
            exit();
        } else {
            $error_message = "Error al realizar la reserva: " . $conn->error;
            include 'error.php';
        }
    } else {
        $error_message = "No se encontró el servicio.";
        include 'error.php';
    }
}

$conn->close(); // Cerrar la conexión a la base de datos

?>