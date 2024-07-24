<?php

// Establecer conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'sistema_facturacion');

// Verificar si hay un error de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

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

            $sql_insertar = "INSERT INTO compras (id_productos, id_persona, cantidad, precio_compra, fecha) VALUES ('$id_producto', '$id_persona', '$cantidad', '$precio_compra', '$fecha')";

            if ($conexion->query($sql_insertar) === TRUE) {
                $sql_precio_compra = "SELECT precio_compra FROM compras WHERE id_productos = '$id_producto' AND id_persona = '$id_persona' AND cantidad = '$cantidad' AND fecha = '$fecha'";
                $resultado_precio_compra = $conexion->query($sql_precio_compra);

                if ($resultado_precio_compra && $resultado_precio_compra->num_rows > 0) {
                    $fila_precio_compra = $resultado_precio_compra->fetch_assoc();
                    $precio_compra_nuevo = $fila_precio_compra["precio_compra"];

                    $nuevo_precio_compra = $precio_compra_nuevo;
                    $nuevo_precio = $nuevo_precio_compra * 1.2;

                    $sql_actualizar_precio = "UPDATE producto SET precio_compra = $nuevo_precio_compra, precio = $nuevo_precio WHERE id_productos = $id_producto";

                    if ($conexion->query($sql_actualizar_precio) !== TRUE) {
                        echo "Error al actualizar el precio de compra en la tabla de productos: " . $conexion->error;
                    }
                } else {
                    echo "Error al guardar la compra: " . $conexion->error;
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
