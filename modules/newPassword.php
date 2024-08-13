<!DOCTYPE html>
<html>
<head>
    <?php include "../php/head.php"; ?>
    <title>Contraseña Nueva</title>
</head>
<body>
    <header class="headerPassword">
        <div class="boxNewPassword">
            <h1>¿Olvidó la contraseña?</h1>
            <p>Escriba su correo electrónico</p>
            <form method="POST" action="../php/resetPassword.php">
                <label for="user">Usuario</label><br>
                <input type="text" id="user" name="user" required><br>
                <label for="email">Correo Electrónico</label><br>
                <input type="email" id="email" name="email" required><br>
                <button type="submit" class="button">Enviar</button><br><br><br>
                <button type="button" class="button" onclick="window.location.href='mainSessionLogin.php'">Continuar</button>
            </form>
        </div>
    </header>
</body>
</html>
