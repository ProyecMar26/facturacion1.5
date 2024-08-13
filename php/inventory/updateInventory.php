<?php

// Verificar si se obtuvieron resultados
if ($resultado_cantidad_total && $resultado_cantidad_total->num_rows > 0) {
    // Recorrer los resultados y actualizar el inventario
    while ($fila = $resultado_cantidad_total->fetch_assoc()) {
        // Obtener el ID del producto y la cantidad total
        $id_producto = $fila["id_productos"];
        $cantidad_total = $fila["cantidad_total"];
        
        // Consulta para obtener el nombre del producto
        $sql_nombre_producto = "SELECT nombre FROM producto WHERE id_productos = '$id_producto'";
        $resultado_nombre_producto = $conn->query($sql_nombre_producto);
        
        // Verificar si se obtuvo el nombre del producto
        if ($resultado_nombre_producto && $resultado_nombre_producto->num_rows > 0) {
            // Obtener el nombre del producto
            $nombre_producto = $resultado_nombre_producto->fetch_assoc()["nombre"];
            
            // Insertar los datos en la tabla inventario
            $sql_insertar = "INSERT INTO inventario (id_productos, nombre, cantidad) VALUES ('$id_producto', '$nombre_producto', '$cantidad_total')";
            
            // Ejecutar la consulta de inserción
            if ($conn->query($sql_insertar) === TRUE) {
            
            } else {

            }
        } else {
           
        }
    }
} else {

}
?>