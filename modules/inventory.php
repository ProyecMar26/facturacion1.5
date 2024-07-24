<?php
// Establecer conexión a la base de datos
require "../php/conn.php";

// Configurar paginación
$limit = 8; // Número de registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Consultar para obtener el número total de registros en la tabla 'inventario'
$result_total = $conn->query("SELECT COUNT(*) AS total FROM inventario");
$total = $result_total->fetch_assoc()['total'];
$pages = ceil($total / $limit);

// Consultar para obtener los registros de inventario con paginación
$sql_inventario_paginado = "SELECT id_productos, nombre, cantidad FROM inventario LIMIT $start, $limit";
$resultado_inventario_paginado = $conn->query($sql_inventario_paginado);

// Consulta para obtener la cantidad total de cada producto
$sql_cantidad_total = "SELECT id_productos, SUM(cantidad) AS cantidad_total FROM (SELECT id_productos, cantidad FROM compras UNION ALL SELECT id_productos, -cantidad FROM ventas) AS t GROUP BY id_productos";
$resultado_cantidad_total = $conn->query($sql_cantidad_total);

// Consultas para análisis
$sql_mas_vendidos = "SELECT p.nombre AS nombre_producto, SUM(v.cantidad) AS total_ventas FROM ventas v INNER JOIN producto p ON v.id_productos = p.id_productos WHERE v.fecha >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY v.id_productos ORDER BY total_ventas DESC LIMIT 1";
$resultado_mas_vendidos = $conn->query($sql_mas_vendidos);

$sql_menos_vendidos = "SELECT p.nombre AS nombre_producto, SUM(v.cantidad) AS total_ventas FROM ventas v INNER JOIN producto p ON v.id_productos = p.id_productos WHERE v.fecha >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY v.id_productos ORDER BY total_ventas ASC LIMIT 1";
$resultado_menos_vendidos = $conn->query($sql_menos_vendidos);

$sql_total_ventas_mensual = "SELECT SUM(total_ventas) AS total_mensual FROM (SELECT SUM(precio * cantidad) AS total_ventas FROM ventas WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY DATE(fecha)) AS ventas_por_dia";
$resultado_total_ventas_mensual = $conn->query($sql_total_ventas_mensual);

$sql_total_ventas_semanal = "SELECT SUM(total_ventas) AS total_semanal FROM (SELECT SUM(precio * cantidad) AS total_ventas FROM ventas WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY WEEK(fecha)) AS ventas_por_semana";
$resultado_total_ventas_semanal = $conn->query($sql_total_ventas_semanal);

$sql_total_ventas_anual = "SELECT SUM(total_ventas) AS total_anual FROM (SELECT SUM(precio * cantidad) AS total_ventas FROM ventas WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 365 DAY) GROUP BY MONTH(fecha)) AS ventas_por_mes";
$resultado_total_ventas_anual = $conn->query($sql_total_ventas_anual);

$sql_productos_poca_cantidad = "SELECT nombre, cantidad FROM inventario WHERE cantidad < 15";
$resultado_productos_poca_cantidad = $conn->query($sql_productos_poca_cantidad);

// Cerrar la conexión a la base de datos
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "../php/head.php"; ?>
    <title>Inventario</title>
</head>
<body>
    <?php include "../php/navbar.php"; ?>
    
    <?php include "../php/inventory/header.php"; ?>
    
    <?php include "../php/inventory/inventoryTable.php"; ?>
    
    <?php include "../php/inventory/searchForm.php"; ?>
    
    <?php include "../php/inventory/analisisResults.php"; ?>
    
</header>
</body>
</html>

