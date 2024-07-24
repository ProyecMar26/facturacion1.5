<?php
include '../php/conn.php'; // Asegúrate de que la ruta sea correcta

// Definir la variable de página e inicializarla en 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8; // Límite de elementos por página
$offset = ($page - 1) * $limit; // Desplazamiento para la consulta SQL

// Consulta para ordenar primero por id_orden y luego por id_compras
$sql = "SELECT 
            c.id_compras, 
            c.id_orden, 
            c.cantidad, 
            c.precio_compra, 
            c.fecha, 
            p.nombre AS producto, 
            per.nombre AS persona,
            (c.cantidad * c.precio_compra) AS total
        FROM compras c
        JOIN producto p ON c.id_productos = p.id_productos
        JOIN persona per ON c.id_persona = per.id_persona
        ORDER BY c.fecha ASC, c.id_orden ASC, c.id_compras ASC
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<div class="page-container">
            <div class="content">
                <form method="post" action="../php/shopping/editShopping.php">
                    <table>
                        <tr>
                            <th>ID Compra</th>
                            <th>ID Orden</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Persona</th>
                            <th>Total</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>';
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><input type='hidden' name='id_compras[]' value='{$row['id_compras']}'>{$row['id_compras']}</td>
                <td><input type='text' name='id_orden[]' value='{$row['id_orden']}'></td>
                <td><input type='number' name='cantidad[]' value='{$row['cantidad']}'></td>
                <td><input type='number' name='precio_compra[]' value='{$row['precio_compra']}'></td>
                <td><input type='date' name='fecha[]' value='{$row['fecha']}'></td>
                <td><input type='text' name='producto[]' value='{$row['producto']}'></td>
                <td><input type='text' name='persona[]' value='{$row['persona']}'></td>
                <td>{$row['total']}</td>
                <td><button type='submit' name='action' value='update'>Guardar</button></td>
                <td><a href=\"../php/shopping/deleteShopping.php?id={$row['id_compras']}\" onclick=\"return confirm('¿Estás seguro que deseas eliminar esta compra?')\">Eliminar</a></td>
            </tr>";
    }
    echo '    </table>
            </form>
            <div class="pagination">';
    
    // Navegación de paginación
    $result_total = $conn->query("SELECT COUNT(*) AS total FROM compras");
    if ($result_total) {
        $total_rows = $result_total->fetch_assoc()['total'];
        $total_pages = ceil($total_rows / $limit);

        if ($page > 1) {
            echo '<a href="../modules/shopping.php?page=' . ($page - 1) . '" class="pagination-nav">Anterior</a> ';
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="../modules/shopping.php?page=' . $i . '" class="pagination-number">' . $i . '</a> ';
        }
        if ($page < $total_pages) {
            echo '<a href="../modules/shopping.php?page=' . ($page + 1) . '" class="pagination-nav">Siguiente</a>';
        }
    }
    echo '    </div>
        </div>
    </div>';

} else {
    echo '<p>No hay órdenes de compra.</p>';
}

$conn->close();
?>
