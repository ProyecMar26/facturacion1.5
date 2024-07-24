<?php
require "../../php/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_ventas = $_POST['id_ventas'];
    $id_orden = $_POST['id_orden'];
    $fecha = $_POST['fecha'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    
    // Obtener el ID del producto y el precio actualizado según el nuevo nombre
    $sql_info_producto = "SELECT id_productos, precio FROM producto WHERE nombre = '$producto'";
    $result_info_producto = $conn->query($sql_info_producto);
    
    if ($result_info_producto && $result_info_producto->num_rows > 0) {
        $row_producto = $result_info_producto->fetch_assoc();
        $id_productos = $row_producto['id_productos'];
        $precio = $row_producto['precio'];

        // Calcular el total
        $total = $cantidad * $precio;

        // Actualizar la venta en la base de datos
        $sql_update_venta = "UPDATE ventas SET id_orden='$id_orden', fecha='$fecha', id_productos='$id_productos', cantidad='$cantidad', precio='$precio', total='$total' WHERE id_ventas='$id_ventas'";

        if ($conn->query($sql_update_venta) === TRUE) {
            echo "Venta actualizada exitosamente.";
        } else {
            echo "Error actualizando la venta: " . $conn->error;
        }
    } else {
        echo "No se encontró el producto o su precio.";
    }

    $conn->close();
    header("Location: ../../modules/sales.php");
    exit();
}
?>
