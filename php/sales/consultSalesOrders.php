<?php
require "../php/conn.php"; // Incluye la conexión a la base de datos

// Verifica si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta de órdenes de venta existentes
$sql_ordenes_venta = "SELECT * FROM ordenes_venta ORDER BY id_orden ASC";
$resultado_ordenes_venta = $conn->query($sql_ordenes_venta);

// Cierra la conexión a la base de datos
$conn->close();
?>
