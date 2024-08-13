<?php
require "../../conn.php";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_producto = $_POST['nombre'];
    $cantidad = $_POST["cantidad"];
    $precio_compra = $_POST['precio_compra'];
    $persona = $_POST["persona"];

    // Crear la consulta SQL para buscar el ID del producto y su precio por su nombre
    $sql_producto = "SELECT id_productos, precio_compra FROM producto WHERE nombre = '$nombre_producto'";
    $resultado_producto = $conexion->query($sql_producto);

    if ($resultado_producto && $resultado_producto->num_rows > 0) {
        $fila_producto = $resultado_producto->fetch_assoc();
        $id_producto = $fila_producto["id_productos"];
        $precio_compra_actual = $fila_producto["precio_compra"];

        $sql_persona = "SELECT id_persona FROM persona WHERE nombre = '$persona'";
        $resultado_persona = $conexion->query($sql_persona);

        if ($resultado_persona && $resultado_persona->num_rows > 0) {
            $fila_persona = $resultado_persona->fetch_assoc();
            $id_persona = $fila_persona["id_persona"];
            $fecha = date('Y-m-d');

            // Ingresar la compra
            $sql_insertar = "INSERT INTO compras (id_productos, id_persona, cantidad, precio_compra, fecha) VALUES ('$id_producto', '$id_persona', '$cantidad', '$precio_compra', '$fecha')";

            if ($conexion->query($sql_insertar) === TRUE) {
                // Eliminar todos los datos existentes en la tabla de inventario
                $sql_eliminar_inventario = "DELETE FROM inventario";
                $conexion->query($sql_eliminar_inventario);

                // Sumar las cantidades para las compras
                $sql_actualizar_inventario = "INSERT INTO inventario (id_productos, cantidad) 
                                              SELECT id_productos, SUM(cantidad) 
                                              FROM compras 
                                              WHERE id_productos = '$id_producto' 
                                              GROUP BY id_productos";
                $conexion->query($sql_actualizar_inventario);

                // Actualizar el precio de compra y el precio de venta
                $nuevo_precio = $precio_compra * 1.2;
                $sql_actualizar_precio = "UPDATE producto 
                                          SET precio_compra = '$precio_compra', precio = '$nuevo_precio' 
                                          WHERE id_productos = '$id_producto'";

                if ($conexion->query($sql_actualizar_precio) !== TRUE) {
                    echo "Error al actualizar el precio de compra en la tabla de productos: " . $conexion->error;
                }
            } else {
                echo "Error al insertar la compra: " . $conexion->error;
            }
        } else {
            echo "No se encontró ninguna persona con el nombre \"$persona\"";
        }
    } else {
        echo "No se encontró ningún producto con el nombre \"$nombre_producto\"";
    }
}

$conexion->close();
?>
