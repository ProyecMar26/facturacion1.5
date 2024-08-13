<?php
$fecha = date('Y-m-d');
    $documento = $_POST['documento'];

    // Insertar una nueva orden de compra con fecha y documento
    $sql_ordenes = "INSERT INTO ordenes_compra (fecha, documento) VALUES ('$fecha', '$documento')";

    if ($conn->query($sql_ordenes) === TRUE) {
        
    } else {
        echo "<script>
            alert('Error: " . $conn->error . "');
            window.location.href = 'shopping.php'; // Redirige a la página de compras en caso de error
        </script>";
    }
?>
