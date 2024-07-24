<?php
include '../php/conn.php'; // Asegúrate de que la ruta sea correcta

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

// Actualizar la consulta SQL para ordenar primero por id_orden y luego por id_venta
$sql = "SELECT 
            v.id_ventas, 
            v.id_orden, 
            v.fecha, 
            v.cantidad,
            v.precio,  
            v.total, 
            p.nombre AS producto
        FROM ventas v
        JOIN producto p ON v.id_productos = p.id_productos
        ORDER BY v.fecha ASC, v.id_orden ASC, v.id_ventas ASC
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table class='table'>
            <tr>
                <th>ID Venta</th>
                <th>ID Orden</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Precio Total</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <form method='post' action='../php/sales/editSale.php'>
                    <td><input type='hidden' name='id_ventas' value='{$row['id_ventas']}'>{$row['id_ventas']}</td>
                    <td><input type='text' name='id_orden' value='{$row['id_orden']}'></td>
                    <td><input type='date' name='fecha' value='{$row['fecha']}'></td>
                    <td><input type='text' name='producto' value='{$row['producto']}'></td>
                    <td><input type='number' name='cantidad' value='{$row['cantidad']}'></td>
                    <td><input type='number' name='precio' value='{$row['precio']}'></td>
                    <td><input type='number' name='total' value='{$row['total']}' readonly></td>
                    <td><button type='submit'>Guardar</button></td>
                    <td><a href=\"../php/sales/deleteSales.php?id={$row['id_ventas']}\" onclick=\"return confirm('¿Estás seguro que deseas eliminar esta venta?')\">Eliminar</a></td>
                </form>
            </tr>";
    }
    echo "</table>";

    // Obtener el total de registros para paginación
    $result_total = $conn->query("SELECT COUNT(*) AS total FROM ventas");
    if ($result_total) {
        $total_rows = $result_total->fetch_assoc()['total'];
        $total_pages = ceil($total_rows / $limit);

        echo '<div class="pagination">';
        if ($page > 1) {
            echo '<a href="../modules/sales.php?page=' . ($page - 1) . '" class="pagination-nav">Anterior</a> ';
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="../modules/sales.php?page=' . $i . '" class="pagination-number">' . $i . '</a> ';
        }
        if ($page < $total_pages) {
            echo '<a href="../modules/sales.php?page=' . ($page + 1) . '" class="pagination-nav">Siguiente</a>';
        }
        echo '</div>';
    }
} else {
    echo '<p>No hay órdenes de venta.</p>';
}

$conn->close();
?>
