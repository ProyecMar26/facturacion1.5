<div class="boxInventory">
    <h1 class="titleprinci">Inventario</h1>
    <?php
    // Mostrar la tabla de inventario
    if ($resultado_inventario_paginado && $resultado_inventario_paginado->num_rows > 0) {
        echo "<table class='inventory'>";
        echo "<tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Cantidad</th>
              </tr>";
        while ($fila = $resultado_inventario_paginado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id_productos"] . "</td>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["cantidad"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Mostrar paginación
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
    } else {
        echo "No se encontraron productos en el inventario.";
    }
    ?>
</div>
