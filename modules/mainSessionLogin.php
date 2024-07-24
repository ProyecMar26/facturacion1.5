<!DOCTYPE html>
<html>
<head>
	<?php include "../php/head.php"; ?>
	<title>Inicio Sesion</title>
</head>
<body>
	<header>
		<?php include '../php/navbarini.php'; ?>
		<div class="boxLogin">
			<h1>Sistema de Facturación</h1>
			<p>¿Ya te registraste? <a href="userRegister.php" class="ingrese_para_registro">Ingrese para registro</a></p>
			
			<form method="POST" action="../php/login.php">
				<label for="username">Usuario</label ><br>
				<input type="text" id="username" name="username" required><br><br>
				<label for="password">Contraseña</label ><br>
				<input type="password" id="password" name="password" required autocomplete="new-password"><br><br>
				<button type="submit" id="boton" class="button">Ingresar</button>
			</form>
			<div class="forgotPassword">
				<p>¿Olvidaste la contraseña? </p>
				<a href="newPassword.php" class="link_recuperar">Ingrese para recuperarla</a>
			</div>
		</div>
	</header>
</body>
</html>
