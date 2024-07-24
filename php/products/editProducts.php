<?php

require "../../php/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_productos = $_POST['id_productos'];
    $id_categoria = $_POST['id_categoria'];
    $nombre = $_POST['nombre'];
    $precio_compra = $_POST['precio_compra'];
    $precio = $_POST['precio'];

    // Actualizar el producto en la base de datos
    $sql_update_products = "UPDATE producto 
                            SET id_categoria='$id_categoria', nombre='$nombre', precio_compra='$precio_compra', precio='$precio' 
                            WHERE id_productos='$id_productos'";

    if ($conn->query($sql_update_products) === TRUE) {
        
    } else {
        echo "Error actualizando el producto: " . $conn->error;
    }

    $conn->close();
    header("Location: ../../modules/products.php"); // Asegúrate de que la URL de redirección sea la correcta
    exit();
}

?>
