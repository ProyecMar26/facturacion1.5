<?php
// Inicializar la variable
$search_query = '';

// Verificar si se ha enviado el formulario de búsqueda
if (isset($_POST['buscar'])) {
    $search_query = htmlspecialchars($_POST['buscar']);
} elseif (isset($_POST['clear_search'])) {
    // Si se hace clic en "Eliminar Búsqueda", limpiar la búsqueda
    $search_query = '';
}
?>

<form method="post" action="../php/people/search.php" class="people">
    <input type="text" name="buscar">
    <button type="submit">Buscar</button>
    <button type="submit" name="clear_search">Eliminar Búsqueda</button>
</form>
<div class="boxPrint">
    <a href="../php/people/printPeople.php"><button>Imprimir personas</button></a>
</div>
