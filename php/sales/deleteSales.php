<?php
// Verificar si se recibió un ID de venta válido a través de la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID de la venta
    $id_venta = $_GET['id'];

    // Establecer la conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'sistema_facturacion');

    // Verificar si hay un error de conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Crear la consulta SQL para eliminar la venta
    $sql_eliminar = "DELETE FROM ventas WHERE id_ventas = $id_venta";

    // Ejecutar la consulta SQL
    if ($conn->query($sql_eliminar) === TRUE) {
        // Redireccionar de vuelta a la página de ventas después de eliminar la venta
        header("Location: ../../modules/sales.php");
        exit(); // Terminar la ejecución del script después de la redirección
    } else {
        echo "Error al eliminar la venta: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se proporcionó un ID de venta válido, mostrar un mensaje de error
    echo "ID de venta no válido.";
}
?>
