<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_compras = $_GET['id'];
    $conexion = new mysqli('localhost', 'root', '', 'sistema_facturacion');

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql_eliminar = "DELETE FROM compras WHERE id_compras = $id_compras";

    if ($conexion->query($sql_eliminar) === TRUE) {
        header("Location: ../../modules/shopping.php");
        exit();
    } else {
        echo "Error al eliminar la venta: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "ID de venta no válido.";
}
?>
