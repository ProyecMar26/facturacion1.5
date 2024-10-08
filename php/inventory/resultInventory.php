<?php

// Consulta para obtener los productos más vendidos en los últimos 30 días
$sql_mas_vendidos = "SELECT p.nombre AS nombre_producto, SUM(v.cantidad) AS total_ventas 
                     FROM ventas v
                     INNER JOIN producto p ON v.id_productos = p.id_productos
                     WHERE v.fecha >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) 
                     GROUP BY v.id_productos 
                     ORDER BY total_ventas DESC LIMIT 1";

$resultado_mas_vendidos = $conn->query($sql_mas_vendidos);

// Consulta para obtener los productos menos vendidos en los últimos 30 días
$sql_menos_vendidos = "SELECT p.nombre AS nombre_producto, SUM(v.cantidad) AS total_ventas 
                       FROM ventas v
                       INNER JOIN producto p ON v.id_productos = p.id_productos
                       WHERE v.fecha >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) 
                       GROUP BY v.id_productos 
                       ORDER BY total_ventas ASC LIMIT 1";

$resultado_menos_vendidos = $conn->query($sql_menos_vendidos);

// Consulta para obtener el total de ventas mensual
$sql_total_ventas_mensual = "SELECT SUM(total_ventas) AS total_mensual 
                             FROM (SELECT SUM(precio * cantidad) AS total_ventas 
                                   FROM ventas 
                                   WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) 
                                   GROUP BY DATE(fecha)) AS ventas_por_dia";

$resultado_total_ventas_mensual = $conn->query($sql_total_ventas_mensual);

// Consulta para obtener el total de ventas semanal
$sql_total_ventas_semanal = "SELECT SUM(total_ventas) AS total_semanal 
                             FROM (SELECT SUM(precio * cantidad) AS total_ventas 
                                   FROM ventas 
                                   WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
                                   GROUP BY WEEK(fecha)) AS ventas_por_semana";

$resultado_total_ventas_semanal = $conn->query($sql_total_ventas_semanal);

// Consulta para obtener el total de ventas anual
$sql_total_ventas_anual = "SELECT SUM(total_ventas) AS total_anual 
                           FROM (SELECT SUM(precio * cantidad) AS total_ventas 
                                 FROM ventas 
                                 WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 365 DAY) 
                                 GROUP BY MONTH(fecha)) AS ventas_por_mes";

$resultado_total_ventas_anual = $conn->query($sql_total_ventas_anual);


// Consulta para obtener los productos con poca cantidad en inventario
$sql_productos_poca_cantidad = "SELECT nombre, cantidad 
                                FROM inventario 
                                WHERE cantidad < 15";

$resultado_productos_poca_cantidad = $conn->query($sql_productos_poca_cantidad);
?>