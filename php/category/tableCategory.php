<?php
if ($resultado_categoria && $resultado_categoria->num_rows > 0) {
// Si hay categorías, imprimir una tabla HTML con los datos de las categorías
echo "<form method='post' action='../php/category/updateCategory.php'>";
echo "<table border='1'>";
echo "<tr>
    <th>ID Categoría</th>
    <th>Categoría</th>
    <th>Guardar</th>
    <th>Eliminar</th>
    </tr>";
// Iterar sobre cada fila de resultados y mostrar los datos en la tabla
while ($fila = $resultado_categoria->fetch_assoc()) {
    echo "<tr>
        <td><input type='hidden' name='id_categoria[]' value='{$fila['id_categoria']}'>{$fila['id_categoria']}</td>
       	<td><input type='text' name='categoria[]' value='{$fila['categoria']}'></td>
       	<td><button type='submit' name='action' value='update'>Guardar</button></td>
       	<td><a href=\"?id={$fila['id_categoria']}\" onclick=\"return confirm('¿Estás seguro que deseas eliminar esta categoría?')\">Eliminar</a></td>
    </tr>";
}
echo "</table>
</form>";

// Paginación
echo '<div class="pagination paginationCategory">';
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
} else {
    // Si no hay categorías registradas, imprimir un mensaje indicando que no hay categorías
    echo "<p>No hay categorías registradas.</p>";
}
?>