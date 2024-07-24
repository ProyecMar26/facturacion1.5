<?php
// Incluye el archivo de conexión a la base de datos
include 'conn.php';

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos del formulario
    $nombre = $_POST['name'];
    $password = $_POST['password'];
    $repitaPassword = $_POST['repitaPassword'];
    $email = $_POST['email'];

    // Verifica si las contraseñas coinciden
    if ($password !== $repitaPassword) {
        // Las contraseñas no coinciden, muestra un mensaje de error
        echo "Las contraseñas no coinciden.";
    } else {
        // Aquí no ciframos la contraseña
        $hashedPassword = $password; // Esto no es seguro

        // Verifica si el usuario ya existe en la base de datos
        $sql_check_user = "SELECT * FROM usuarios WHERE username = ?";
        $stmt_check_user = $conn->prepare($sql_check_user);
        $stmt_check_user->bind_param("s", $nombre);
        $stmt_check_user->execute();
        $result_check_user = $stmt_check_user->get_result();

        // Si el usuario ya existe, muestra un mensaje de error
        if ($result_check_user->num_rows > 0) {
            echo '<script>alert("El usuario ya existe"); window.location.href = "../modules/userRegister.php";</script>';
        } else {
            // Inserta el nuevo usuario en la base de datos
            $sql_insert_user = "INSERT INTO usuarios (username, password, email) VALUES (?, ?, ?)";
            $stmt_insert_user = $conn->prepare($sql_insert_user);
            $stmt_insert_user->bind_param("sss", $nombre, $hashedPassword, $email);

            // Ejecuta la consulta
            if ($stmt_insert_user->execute()) {
                // Registro exitoso
                echo '<script>alert("Registro exitoso"); window.location.href = "../modules/userRegister.php";</script>';
            } else {
                // Error al registrar
                echo "Error al registrar el usuario.";
            }
        }
    }
} else {
    // Si no se envió el formulario, redirige al formulario de registro
    header("Location: ../php/register.php");
    exit();
}
?>
