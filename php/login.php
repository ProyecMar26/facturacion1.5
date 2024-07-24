<?php
session_start();
include 'conn.php'; // Asegúrate de que este archivo contenga la conexión a tu base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Usuario autenticado correctamente
        $_SESSION['username'] = $username;
        header("Location: ../modules/homepage"); // Redirige al usuario a la página principal
        exit();
    } else {
        // Credenciales incorrectas, redirige al formulario de inicio de sesión con un mensaje de error
       echo '<script>alert("Usuario/Contraseña no coinciden"); window.location.href = "../modules/mainSessionLogin";</script>';
        exit();
    }
} else {
    // Redirige al formulario de inicio de sesión si se intenta acceder al script PHP directamente
    header("Location: ../modules/inicio_sesion.php");
    exit();
}
?>
