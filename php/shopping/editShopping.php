<?php
require "../../php/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asegúrate de que todos los campos se reciban como arrays si se espera que haya múltiples entradas
    $id_compras = $_POST['id_compras'];
    $id_orden = $_POST['id_orden'];
    $fecha = $_POST['fecha'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $precio_compra = $_POST['precio_compra'];

    // Si `id_compras` es un array, recórrelo para actualizar cada registro
    if (is_array($id_compras)) {
        $error = false; // Bandera para verificar si hubo algún error durante la actualización
        for ($i = 0; $i < count($id_compras); $i++) {
            $id_compra = $id_compras[$i];
            $orden = $id_orden[$i];
            $fecha_item = $fecha[$i];
            $producto_item = $producto[$i];
            $cantidad_item = $cantidad[$i];
            $precio_compra_item = $precio_compra[$i];
            
            // Obtener el ID del producto según el nuevo nombre
            $sql_info_producto = "SELECT id_productos FROM producto WHERE nombre = ?";
            $stmt_info_producto = $conn->prepare($sql_info_producto);

            if ($stmt_info_producto === false) {
                die("Error en prepare() para sql_info_producto: " . $conn->error);
            }

            $stmt_info_producto->bind_param("s", $producto_item);
            $stmt_info_producto->execute();
            $result_info_producto = $stmt_info_producto->get_result();
            
            if ($result_info_producto && $result_info_producto->num_rows > 0) {
                $row_producto = $result_info_producto->fetch_assoc();
                $id_productos = $row_producto['id_productos'];

                // Calcular el total
                $total = $cantidad_item * $precio_compra_item;

                // Actualizar la compra en la base de datos
                $sql_update_compra = "UPDATE compras SET id_orden=?, fecha=?, id_productos=?, cantidad=?, precio_compra=?, total=? WHERE id_compras=?";
                $stmt_update_compra = $conn->prepare($sql_update_compra);
                
                if ($stmt_update_compra === false) {
                    die("Error en prepare() para sql_update_compra: " . $conn->error);
                }

                // Actualiza la cadena de definición de tipo a 'ssiiddi'
                $stmt_update_compra->bind_param("ssiiddi", $orden, $fecha_item, $id_productos, $cantidad_item, $precio_compra_item, $total, $id_compra);

                if (!$stmt_update_compra->execute()) {
                    echo "Error actualizando la compra: " . $stmt_update_compra->error;
                    $error = true; // Marca que ocurrió un error
                }
                
                $stmt_update_compra->close();

            } else {
                echo "No se encontró el producto para el producto: $producto_item.";
                $error = true; // Marca que ocurrió un error
            }

            $stmt_info_producto->close();
        }

        // Redirige después de procesar todos los registros
        if (!$error) {
            header("Location: ../../modules/shopping.php");
            exit(); // Asegúrate de que no se ejecute ningún código adicional después de redirigir
        }
    } else {
        // Manejo si no se espera que `id_compras` sea un array
        echo "Se esperaba un array para 'id_compras'.";
    }

    $conn->close();
}
?>
