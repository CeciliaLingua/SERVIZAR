<!-- PROCESO REGISTRO -->
<?php
// Incluir la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "proyectouniversidad";

$conn = new mysqli($servername, $username, $password_db, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asegúrate de que los campos están definidos en el formulario HTML
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? $conn->real_escape_string($_POST['apellido']) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $contraseña = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : '';
    $contraseña1 = isset($_POST['password_confirm']) ? $conn->real_escape_string($_POST['password_confirm']) : '';
    $telefono = isset($_POST['telefono']) ? $conn->real_escape_string($_POST['telefono']) : '';
    $provincia = isset($_POST['provincia']) ? $conn->real_escape_string($_POST['provincia']) : '';
    $localidad = isset($_POST['localidad']) ? $conn->real_escape_string($_POST['localidad']) : '';

    // Verificar si las contraseñas coinciden
    if ($contraseña !== $contraseña1) {
        echo "Las contraseñas no coinciden.";
    } else {
        // Verificar si el email ya existe
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "El email ya está en uso.";
        } else {
            // No hashear la contraseña, almacenar como texto plano
            // Insertar el nuevo usuario en la base de datos
            $sql = "INSERT INTO users (nombre, apellido, email, password, telefono, provincia, localidad) 
                    VALUES ('$nombre', '$apellido', '$email', '$contraseña', '$telefono', '$provincia', '$localidad')";

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");  // Redirigir a otra página después de registrar
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>
