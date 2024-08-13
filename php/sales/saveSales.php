<?php
require "../php/conn.php"; // Asegúrate de incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'guardar_venta') {
    // Obtener los datos del formulario de ventas
    $nombre = $_POST['nombre'];
    $cantidad = $_POST["cantidad"];
    $id_orden = $_POST["categoria"]; // Obtener el ID de la orden de venta seleccionada

    // Crear la consulta SQL para buscar el ID del producto y su precio por su nombre
    $sql_producto = "SELECT id_productos, precio FROM producto WHERE nombre = ?";
    $stmt_producto = $conn->prepare($sql_producto);
    $stmt_producto->bind_param("s", $nombre);
    $stmt_producto->execute();
    $resultado_producto = $stmt_producto->get_result();

    // Verificar si se encontró el producto en la tabla producto
    if ($resultado_producto && $resultado_producto->num_rows > 0) {
        // Obtener el ID del producto y su precio
        $fila_producto = $resultado_producto->fetch_assoc();
        $id_productos = $fila_producto["id_productos"];
        $precio = $fila_producto["precio"];

        // Crear la consulta SQL para verificar si existe el producto en la tabla compras
        $sql_compras = "SELECT SUM(cantidad) AS total_comprado FROM compras WHERE id_productos = ?";
        $stmt_compras = $conn->prepare($sql_compras);
        $stmt_compras->bind_param("i", $id_productos);
        $stmt_compras->execute();
        $resultado_compras = $stmt_compras->get_result();

        // Verificar si se encontró el producto en la tabla compras
        if ($resultado_compras && $resultado_compras->num_rows > 0) {
            $fila_compras = $resultado_compras->fetch_assoc();
            $total_comprado = $fila_compras["total_comprado"];

            // Crear la consulta SQL para verificar las ventas existentes del producto
            $sql_ventas = "SELECT SUM(cantidad) AS total_vendido FROM ventas WHERE id_productos = ?";
            $stmt_ventas = $conn->prepare($sql_ventas);
            $stmt_ventas->bind_param("i", $id_productos);
            $stmt_ventas->execute();
            $resultado_ventas = $stmt_ventas->get_result();

            $total_vendido = 0;
            if ($resultado_ventas && $resultado_ventas->num_rows > 0) {
                $fila_ventas = $resultado_ventas->fetch_assoc();
                $total_vendido = $fila_ventas["total_vendido"];
            }

            // Calcular el stock disponible
            $stock_disponible = $total_comprado - $total_vendido;

            if ($stock_disponible >= $cantidad) {
                // Calcular el total
                $total = $precio * $cantidad;
                $fecha = date('Y-m-d');

                // Crear la consulta SQL para insertar la venta en la base de datos
                $sql_insertar = "INSERT INTO ventas (id_productos, id_orden, fecha, cantidad, precio, total) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt_insertar = $conn->prepare($sql_insertar);
                $stmt_insertar->bind_param("iisidd", $id_productos, $id_orden, $fecha, $cantidad, $precio, $total);

                // Ejecutar la consulta SQL para insertar la venta
                if ($stmt_insertar->execute()) {
                    $productos_restantes = $stock_disponible - $cantidad;
                    
                } else {
                    echo "<script>alert('Error al guardar la venta: " . $stmt_insertar->error . "');</script>";
                }
                $stmt_insertar->close();
            } else {
                echo "<script>alert('Error: No se puede realizar la venta por falta del producto \"$nombre\" en cantidad suficiente. Quedan $stock_disponible productos.');</script>";
            }
            $stmt_ventas->close();
        } else {
            echo "<script>alert('No se encontró el producto \"$nombre\" en la tabla compras.');</script>";
        }
        $stmt_compras->close();
    } else {
        echo "<script>alert('No se encontró ningún producto con el nombre \"$nombre\".');</script>";
    }
    $stmt_producto->close();
    $conn->close();
}
?>
