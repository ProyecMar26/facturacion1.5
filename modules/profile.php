<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header("Location: ../php/login.php");
    exit();
}

// Conexión a la base de datos
include '../php/conn.php';

// Obtener la información del usuario
$username = $_SESSION['username'];
$sql = "SELECT nombre, email, image FROM usuarios WHERE username = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta SQL: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$currentName = $row['nombre'];
$currentEmail = $row['email'];
$currentImage = $row['image'];
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "../php/head.php"; ?>
    <title>Perfil</title>
</head>
<body>
    <header>
        <?php include '../php/navbar.php'; ?>
        <?php include '../php/boxSetting.php'; ?>
        <div class="boxProfile setting box">
            <img src="<?php echo htmlspecialchars($currentImage ? '../uploads/' . $currentImage : '../img/placeholder.png'); ?>" class="profileImage">
            <div class="profile">
                <p>Nombre de Usuario: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                <p>Nombre: <?php echo htmlspecialchars($currentName); ?></p>
                <p>Correo Electrónico: <?php echo htmlspecialchars($currentEmail); ?></p>
            </div>
            <form action="../php/login/updateProfile.php" method="POST" enctype="multipart/form-data" class="profile2">
                <p>Cambiar nombre</p>
                <input type="text" name="Nombre" id="input_perfil" value="<?php echo htmlspecialchars($currentName); ?>">
                <p>Cambiar correo electrónico</p>
                <input type="email" name="Email" id="input_perfil" value="<?php echo htmlspecialchars($currentEmail); ?>">
                <p>Cambiar contraseña</p>
                <input type="password" name="Contraseña" id="input_perfil">
                <p>Cambiar imagen</p>
                <input type="file" name="imagen" id="input_imagen">
                <button type="submit" id="boton" class="save">Guardar</button>
            </form>
        </div>
    </header>
</body>
</html>
