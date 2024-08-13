<!DOCTYPE html>
<html>
<head>
    <?php include "../php/head.php"; ?>
    <title>Registro</title>
</head>
<body>
    <header class="headerRegister">
        <div class="boxRegister">
            <h1>Sistema de Facturación</h1>
            <p>¿Ya te registraste? <a href="mainSessionLogin.php">Inicia Sesión</a></p><br><br>
            <form method="POST" action="../php/register.php">
                <label for="username">Escriba un usuario</label><br>
                <input type="text" name="username" id="username" required><br><br>
                <label for="name">Escriba su nombre</label><br>
                <input type="text" name="name" id="name" required><br><br>
                <label for="password">Escriba su contraseña</label><br>
                <input type="password" name="password" id="password" autocomplete="new-password" required><br><br>
                <label for="repitaPassword">Repita su contraseña</label><br>
                <input type="password" name="repitaPassword" id="repitaPassword" required><br><br>
                <label for="email">Correo Electrónico</label><br>
                <input type="text" name="email" id="email" required><br><br>
                <button type="submit" id="boton" class="button">Continuar</button>
            </form>
        </div>
    </header>
</body>
</html>
