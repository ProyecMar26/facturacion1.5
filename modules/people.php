<?php
// Establecer conexión a la base de datos
require __DIR__ . '/../php/conn.php';

require '../php/people/newPeople.php';

require '../php/people/deletePeople.php';

// Obtener todas las personas de la tabla persona
$sql_personas = "SELECT * FROM persona";
$resultado_personas = $conn->query($sql_personas);
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "../php/head.php"; ?>
    <title>Personas</title>
</head>
<body>
    <header>
        <?php include '../php/navbar.php'; ?>
        <div class="boxPeople box">
            <h1>Personas</h1>
            <form method="post" action="../php/people/newPeople.php">
                <label for="documento">Documento</label>
                <input type="number" name="documento" class="form"><br>  
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form">
                <label for="direccion"><br>Dirección</label>
                <input type="text" name="direccion" class="form"><br>
                <label for="telefono">Teléfono</label>
                <input type="number" name="telefono" class="form"><br>
                <label for="empresa">Empresa</label>
                <input type="text" name="empresa" class="form"><br><br>
                <button type="submit">Guardar persona</button><br><br>
            </form>
        </div>
        <div class="boxPeople3 box">
                <h2>Buscar Personas</h2>
                <?php include "../php/people/searchPeople.php"; ?>
        </div>
        <div class="boxPeople2 box">
            <form class="tabla_compras">
                <?php
                include '../php/people/tablePeople.php';
                ?>
            </form>
        </div>
    </header>
</body>
</html>