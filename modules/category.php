<?php
// Establecer conexión a la base de datos
require "../php/conn.php";

// Paginación
$limit = 9; // Número de registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

require '../php/category/newCategory.php';

require '../php/category/deleteCategory.php';

// Consulta para obtener el número total de categorías
$result = $conn->query("SELECT COUNT(*) AS total FROM categoria");
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
$total = $result->fetch_assoc()['total'];
$pages = ceil($total / $limit);

// Consulta para obtener las categorías con paginación
$sql_categoria = "SELECT * FROM categoria LIMIT $start, $limit";
$resultado_categoria = $conn->query($sql_categoria);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "../php/head.php"; ?>
    <title>Categorías</title>
</head>
<body>
    <header>
        <?php include '../php/navbar.php'; ?>
        <div class="boxCategory">
            <h1>Categorías</h1>
            <form method="post">
                <label for="categoria">Nombre de la categoria</label><br>
                <input type="text" name="categoria" id="categoria" class="form"><br><br> 
                <button type="submit">Guardar categoría</button><br><br>
            </form>
        </div>
        <div class="boxCategory2">
            <h2>Categorias</h2>
            <?php
            include '../php/category/tableCategory.php';
            ?>
        </div>
    </header>
</body>
</html>
