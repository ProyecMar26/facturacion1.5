<?php
include '../php/conn.php'; // Asegúrate de que la ruta sea correcta

$limit = 8; // Número de registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Consulta para obtener el número total de productos
$result = $conn->query("SELECT COUNT(*) AS total FROM producto");
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
$total = $result->fetch_assoc()['total'];
$pages = ceil($total / $limit);

// Consulta para obtener los productos con paginación
$products = $conn->query("SELECT * FROM producto LIMIT $start, $limit");
if (!$products) {
    die("Error en la consulta: " . $conn->error);
}

if ($products && $products->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
        <th>ID Producto</th>
        <th>ID Categoría</th>
        <th>Nombre</th>
        <th>Precio Compra</th>
        <th>Precio</th>
        <th>Guardar</th>
        <th>Eliminar</th>
    </tr>";
    while ($fila = $products->fetch_assoc()) {
        echo "<tr>
            <form method='post' action='../php/products/editProducts.php'>
                <td><input type='hidden' name='id_productos' value='{$fila['id_productos']}'>{$fila['id_productos']}</td>
                <td><input type='text' name='id_categoria' value='{$fila['id_categoria']}'></td>
                <td><input type='text' name='nombre' value='{$fila['nombre']}'></td>
                <td><input type='number' name='precio_compra' value='{$fila['precio_compra']}'></td>
                <td><input type='number' name='precio' value='{$fila['precio']}'></td>
                <td><button type='submit'>Guardar</button></td>
                <td><a href=\"?id={$fila['id_productos']}\" onclick=\"return confirm('¿Estás seguro que deseas eliminar este producto?')\">Eliminar</a></td>
            </form>
        </tr>";
    }
    echo "</table>";

   echo '<div class="pagination">';
if ($page > 1) {
    echo '<a href="?page=' . ($page - 1) . '" class="pagination-nav">Anterior</a>';
}
for ($i = 1; $i <= $pages; $i++) {
    echo '<a href="?page=' . $i . '" class="pagination-number">' . $i . '</a>';
}
if ($page < $pages) {
    echo '<a href="?page=' . ($page + 1) . '" class="pagination-nav">Siguiente</a>';
}
echo '</div>';
}
?>
