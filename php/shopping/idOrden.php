<?php
$sql_producto = "SELECT id_productos, precio_compra FROM producto WHERE nombre = '$nombre_producto'";
$resultado_producto = $conn->query($sql_producto);

if ($resultado_producto && $resultado_producto->num_rows > 0) {
    $fila_producto = $resultado_producto->fetch_assoc();
    $id_producto = $fila_producto["id_productos"];
    $precio_compra_actual = $fila_producto["precio_compra"];

    $sql_persona = "SELECT id_persona FROM persona WHERE nombre = '$persona'";
    $resultado_persona = $conn->query($sql_persona);

    if ($resultado_persona && $resultado_persona->num_rows > 0) {
        $fila_persona = $resultado_persona->fetch_assoc();
        $id_persona = $fila_persona["id_persona"];
        $fecha = date('Y-m-d');

        // Calcular el nuevo precio basado en el precio de compra
        $nuevo_precio = $precio_compra_actual * 1.2;

        // Calcular el total
        $total = $cantidad * $nuevo_precio;

        // Insertar la compra en la base de datos con el total
        $sql_insertar = "INSERT INTO compras (id_productos, id_persona, id_orden, cantidad, precio_compra, total, fecha) 
                         VALUES ('$id_producto', '$id_persona', '$id_orden', '$cantidad', '$precio_compra', '$total', '$fecha')";

        if ($conn->query($sql_insertar) === TRUE) {
            // Actualizar el precio en la tabla de productos
            $sql_actualizar_precio = "UPDATE producto SET precio_compra = $precio_compra_actual, precio = $nuevo_precio WHERE id_productos = $id_producto";

            if ($conn->query($sql_actualizar_precio) === TRUE) {
                
            } else {
                echo "Error al actualizar el precio de compra en la tabla de productos: " . $conn->error;
            }
        } else {
            echo "<script> alert('Error al guardar la compra: " . $conn->error . "')</script>";
        }
    } else {
        echo "<script> alert('No se encontró ninguna persona con el nombre \"$persona\"')</script>";
    }
} else {
    echo "<script> alert('No se encontró ningún producto con el nombre \"$nombre_producto\"')</script>";
}
?>
