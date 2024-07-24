<!DOCTYPE html>
<html>
<head>
	<?php
	include "../php/head.php";
	?>
	<title>Perfil</title>
</head>
<body>
	<header>
		<?php include '../php/navbar.php'; 
         include '../php/boxSetting.php'; ?>
		<div class="boxProfile">
			<img src="../img/imagen.jpg" class="imgmio">
			<div class="profile">
				<p>Mariana Muñoz</p>
				<p>mariana.muoz74@soy.sena.edu.co</p>
			</div>
			<form>
				<p>Cambiar nombre</p>
				<input type="text" name="Nombre" id="input_perfil">
				<p>Cambiar correo electronico</p>
				<input type="email" name="Email" id="input_perfil">
				<p>Cambiar documento</p>
				<input type="number" name="Documento" id="input_perfil">
				<p>Cambiar contraseña</p>
				<input type="text" name="Contraseña" id="input_perfil">
			</form>
			<button id="boton" class="save">Guardar</button>
		</div>
	</header>
</body>
</html>