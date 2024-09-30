<!-- PROCESO INICIAR SESION -->
<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password_db = ""; 
$dbname = "proyectouniversidad";

$conn = new mysqli($servername, $username, $password_db, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

    $sql = "SELECT id, nombre, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña en texto claro
        if ($contraseña === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $user['nombre'];

            header("Location: index.php");
            exit();
        } else {
            echo "Email o contraseña incorrectos.";
        }
    } else {
        echo "Email o contraseña incorrectos.";
    }
}

$conn->close();
?>
