<?php
// Consulta para obtener la cantidad total de cada producto
$sql_cantidad_total = "SELECT id_productos, SUM(cantidad) AS cantidad_total FROM (SELECT id_productos, cantidad FROM compras UNION ALL SELECT id_productos, -cantidad FROM ventas) AS t GROUP BY id_productos";
// Ejecutar la consulta SQL
$resultado_cantidad_total = $conn->query($sql_cantidad_total);
?>