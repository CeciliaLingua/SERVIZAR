<?php
include('conexionbd.php'); // Asegúrate de tener este archivo para la conexión a la base de datos

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    // Iniciar una transacción para asegurar consistencia
    $conn->begin_transaction();

    try {
        // Eliminar los registros de la tabla detalles_reserva que referencian este producto
        $sql_detalles = "DELETE FROM detalles_reserva WHERE id_servicio = ?";
        $stmt_detalles = $conn->prepare($sql_detalles);
        $stmt_detalles->bind_param("i", $producto_id);
        $stmt_detalles->execute();

        // Ahora eliminar el producto de la tabla productos
        $sql_producto = "DELETE FROM productos WHERE id = ?";
        $stmt_producto = $conn->prepare($sql_producto);
        $stmt_producto->bind_param("i", $producto_id);

        if ($stmt_producto->execute()) {
            // Confirmar la transacción
            $conn->commit();
            header("Location: usuario.php?mensaje=Producto eliminado correctamente");
        } else {
            throw new Exception("Error al eliminar el producto");
        }

    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $stmt_detalles->close();
    $stmt_producto->close();
    $conn->close();
}
?>