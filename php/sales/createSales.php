<?php
// Verificar si se envió el formulario de nueva orden de venta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'crear_orden') {
    $fecha = date('Y-m-d');
    $documento = $_POST['documento'];

    // Insertar una nueva orden de venta con fecha y documento
    $sql_ordenes = "INSERT INTO ordenes_venta (fecha, documento) VALUES ('$fecha', '$documento')";

    if ($conn->query($sql_ordenes) === TRUE) {
        
    } else {
        echo "Error al crear nueva orden de venta: " . $conn->error;
    }
}
?>
