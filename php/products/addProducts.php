<?php
// addProducts.php

function add_product($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['clear_search'])) {
        $nombre_producto = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
        $precio_compra = isset($_POST['precio_compra']) ? $_POST['precio_compra'] : '';

        if (!empty($nombre_producto) && !empty($categoria) && !empty($precio_compra)) {
            $nombre_producto = $conn->real_escape_string($nombre_producto);
            $categoria = $conn->real_escape_string($categoria);
            $precio_compra = $conn->real_escape_string($precio_compra);

            // Verificar si el producto ya existe
            $sql_verificar_nombre = "SELECT * FROM producto WHERE nombre = '$nombre_producto'";
            $resultado_verificacion = $conn->query($sql_verificar_nombre);

            if ($resultado_verificacion && $resultado_verificacion->num_rows > 0) {
                echo "<script>alert('Error: el producto \"$nombre_producto\" ya existe en la base de datos.');</script>";
            } else {
                // Obtener ID de la categoría
                $sql_categoria = "SELECT id_categoria FROM categoria WHERE LOWER(categoria) = LOWER('$categoria')";
                $resultado_categoria = $conn->query($sql_categoria);

                if ($resultado_categoria && $resultado_categoria->num_rows > 0) {
                    $fila_categoria = $resultado_categoria->fetch_assoc();
                    $id_categoria = $fila_categoria["id_categoria"];
                    $porcentaje_aumento = 20;
                    $precio = $precio_compra * (1 + $porcentaje_aumento / 100);

                    // Insertar producto
                    $sql_insertar = "INSERT INTO producto (id_categoria, nombre, precio_compra, precio) 
                                     VALUES ('$id_categoria', '$nombre_producto', '$precio_compra', '$precio')";

                    if ($conn->query($sql_insertar) === TRUE) {
                        
                    } else {
                        echo "Error al guardar el producto: " . $conn->error;
                    }
                } else {
                    echo "No se encontró ninguna categoría con el nombre \"$categoria\"";
                }
            }
        } else {
            
        }
    }
}

add_product($conn);
