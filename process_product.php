<?php
include 'conexionbd.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageName = basename($_FILES['image']['name']);
    $imagePath = './img/products/' . $imageName;

    // Verificar tipo de archivo
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['image']['type'];
    if (!in_array($fileType, $allowedTypes)) {
        die("Solo se permiten imágenes JPG, PNG o GIF.");
    }

    if (move_uploaded_file($imageTmpPath, $imagePath)) {
        // Recoger datos del formulario
        $categoriaId = isset($_POST['categoriaId']) ? $_POST['categoriaId'] : '';
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';  // Capturando el userId

        // Verificar que se han recibido todos los datos necesarios
        if (empty($categoriaId) || empty($nombre) || empty($descripcion) || empty($precio) || empty($userId)) {
            die("Todos los campos son requeridos.");
        }

        // Escapar datos para evitar inyección de SQL
        $categoriaId = $conn->real_escape_string($categoriaId);
        $nombre = $conn->real_escape_string($nombre);
        $descripcion = $conn->real_escape_string($descripcion);
        $precio = $conn->real_escape_string($precio);
        $imageName = $conn->real_escape_string($imageName);
        $userId = $conn->real_escape_string($userId);  // Escapando el userId

        // Insertar el nuevo producto en la base de datos incluyendo el userId
        $sql = "INSERT INTO productos (categoriaId, image, nombre, descripcion, precio, userId) 
                VALUES ('$categoriaId', '$imageName', '$nombre', '$descripcion', '$precio', '$userId')";

        if ($conn->query($sql) === TRUE) {
            // Redirige a la página del formulario con un parámetro de éxito
            header("Location: crear_producto.php?success=1");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
} else {
    echo "No image file uploaded or file upload error.";
}

$conn->close();
?>