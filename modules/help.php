<!DOCTYPE html>
<html>
<head>
	<?php
	include "../php/head.php"
	?>
	<title>Ayuda</title>
</head>
<body>
	<header>
		<?php include '../php/navbar.php'; ?>
		<div class="boxHelp">
			<form>
				<label for="textHelp" class="textHelp">Ayuda</label>
				<input type="text" id="textHelp" name="textHelp">
				<label for="comments" class="comments">Comentarios</label>
				<input type="text" id="comments" name="comments"><br><br>
				<button class="button">Enviar</button>
			</form>
		</div>
	</header>
</body>
</html>