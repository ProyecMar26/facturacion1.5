<?php
require "../../php/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_ventas = $_POST['id_ventas'];
    $id_orden = $_POST['id_orden'];
    $fecha = $_POST['fecha'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    
    // Obtener el ID del producto y el precio actualizado según el nuevo nombre
    $sql_info_producto = "SELECT id_productos, precio FROM producto WHERE nombre = ?";
    $stmt = $conn->prepare($sql_info_producto);
    $stmt->bind_param("s", $producto);
    $stmt->execute();
    $result_info_producto = $stmt->get_result();
    
    if ($result_info_producto && $result_info_producto->num_rows > 0) {
        $row_producto = $result_info_producto->fetch_assoc();
        $id_productos = $row_producto['id_productos'];
        $precio = $row_producto['precio'];

        // Calcular el total
        $total = $cantidad * $precio;

        // Actualizar la venta en la base de datos
        $sql_update_venta = "UPDATE ventas SET id_orden = ?, fecha = ?, id_productos = ?, cantidad = ?, precio = ?, total = ? WHERE id_ventas = ?";
        $stmt_update = $conn->prepare($sql_update_venta);
        $stmt_update->bind_param("isiiddi", $id_orden, $fecha, $id_productos, $cantidad, $precio, $total, $id_ventas);

        if ($stmt_update->execute()) {
            echo "Venta actualizada exitosamente.";
        } else {
            echo "Error actualizando la venta: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        echo "No se encontró el producto o su precio.";
    }

    $stmt->close();
    $conn->close();
    
    header("Location: ../../modules/sales.php");
    exit();
}
?>
