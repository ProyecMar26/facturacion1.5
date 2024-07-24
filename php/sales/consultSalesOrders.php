<?php
// Consulta de órdenes de venta existentes
$sql_ordenes_venta = "SELECT * FROM ordenes_venta ORDER BY id_orden ASC";
$resultado_ordenes_venta = $conn->query($sql_ordenes_venta);
?>
