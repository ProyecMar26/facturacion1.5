<?php
// Verificar si se recibió el parámetro "id" en la URL para eliminar una persona
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id_persona = $_GET["id"];
    $sql_eliminar = "DELETE FROM persona WHERE id_persona=$id_persona";
    
    if ($conn->query($sql_eliminar) === TRUE) {
    
    } else {
        echo "Error al eliminar la persona: " . $conn->error;
    }
}
?>
