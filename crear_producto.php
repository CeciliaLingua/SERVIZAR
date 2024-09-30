<!--- CREAR PRODUCTO/SERVICIO-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Crear Producto</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/LOGO%20CHIQUITO.png" rel="icon" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php include 'barra_simple.php'; ?>
    <!-- Topbar End -->
    <?php

include('conexionbd.php'); // Incluye la conexión a la base de datos

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciar_sesion.php"); // Redirige al usuario a la página de inicio de sesión
    exit();
}
?>

    <?php if (isset($_GET['success']) && $_GET['success'] == '1'):
        echo '<div class="alert alert-success">El servicio se creo correctamente.</div>';
    endif; ?>

<div class= "bg-blue" >
    <h2>Crear servicio</h2>
    <form class="container" action="process_product.php" method="post" enctype="multipart/form-data" style=" margin-top: 35px; ">
        <div class="form-group" >
            <label for="nombre" style="color: white; ">Nombre del Servicio:</label>
            <input type="text" id="nombre" name="nombre" style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 20px;" required>
        </div>
        <div class="form-group">
            <label for="categoriaId" style="color: white; ">Categoría:</label>
            <select id="categoriaId" name="categoriaId" style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 20px;" required>
                <?php
                include 'conexionbd.php';
                $sql = "SELECT id, categoria FROM categorias";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['categoria']) . '</option>';
                }
                $conn->close();
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="descripcion" style="color: white; ">Descripción:</label>
            <textarea id="descripcion" name="descripcion" style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 20px;" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="precio" style="color: white; ">Precio:</label>
            <input type="text" id="precio" name="precio" style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 20px;" required>
        </div>
        <!-- Campo oculto para el userId, obteniendo el valor desde la sesión -->
        <div class="form-group">
            <input type="hidden" id="userId" name="userId" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
        </div>
        <div class="form-group">
            <label for="image" style="color: white; " >Imagen del Producto:</label>
            <input type="file" id="image" name="image" style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 20px;" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary" style="border-radius: 25px; margin-bottom: 50px;">Crear Producto</button>
    </form>
            </div>
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>