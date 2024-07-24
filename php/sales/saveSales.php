<?php
// Manejo del formulario de guardar venta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'guardar_venta') {
    // Obtener los datos del formulario de ventas
    $nombre = $_POST['nombre'];
    $cantidad = $_POST["cantidad"];
    $id_orden = $_POST["categoria"]; // Obtener el ID de la orden de venta seleccionada

    // Crear la consulta SQL para buscar el ID del producto y su precio por su nombre
    $sql = "SELECT id_productos, precio FROM producto WHERE nombre = '$nombre'";
    
    // Ejecutar la consulta SQL
    $resultado = $conn->query($sql);
    
    // Verificar si se encontró el producto
    if ($resultado && $resultado->num_rows > 0) {
        // Obtener el ID del producto y su precio
        $fila_producto = $resultado->fetch_assoc();
        $id_productos = $fila_producto["id_productos"]; // Corregido
        $precio = $fila_producto["precio"];
        $fecha = date('Y-m-d');

        // Calcular el total
        $total = $precio * $cantidad;

        // Crear la consulta SQL para insertar la venta en la base de datos
        $sql_insertar = "INSERT INTO ventas (id_productos, id_orden, fecha, cantidad, precio, total) VALUES ('$id_productos', '$id_orden' ,'$fecha','$cantidad','$precio','$total')";

        // Ejecutar la consulta SQL para insertar la venta
        if ($conn->query($sql_insertar) === TRUE) {
            // Aquí puedes imprimir un mensaje de éxito si lo deseas
        } else {
            echo "Error al guardar la venta: " . $conn->error;
        }
    } else {
        echo "No se encontró ningún producto con el nombre \"$nombre\"";
    }
}
?>
