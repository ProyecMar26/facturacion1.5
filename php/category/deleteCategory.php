<?php
// Verificar si se envió una solicitud GET para eliminar una categoría
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Obtener el ID de la categoría a eliminar
    $id = $_GET["id"];
    // Crear la consulta SQL para eliminar la categoría con el ID especificado
    $sql_eliminar = "DELETE FROM categoria WHERE id_categoria = $id";

    // Ejecutar la consulta SQL
    if ($conn->query($sql_eliminar) === TRUE) {
        echo "<script>alert('Categoría eliminada correctamente.');</script>";
    } else {
        echo "Error al eliminar la categoría: " . $conn->error;
    }
}
?>
