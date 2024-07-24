<?php

require "../../php/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_persona = $_POST['id_persona'];
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $empresa = $_POST['empresa'];

    // Actualizar la persona en la base de datos
    $sql_update_persona = "UPDATE persona 
                            SET documento='$documento', nombre='$nombre', direccion='$direccion', telefono='$telefono', empresa='$empresa' 
                            WHERE id_persona='$id_persona'";

    if ($conn->query($sql_update_persona) === TRUE) {
        echo "<script>alert('Persona actualizada exitosamente.');</script>";
    } else {
        echo "Error actualizando la persona: " . $conn->error;
    }

    $conn->close();
    header("Location: ../../modules/people.php"); // Asegúrate de que la URL de redirección sea la correcta
    exit();
}
?>
