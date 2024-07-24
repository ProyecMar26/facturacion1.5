<?php
function delete_product($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql_eliminar = "DELETE FROM producto WHERE id_productos=$id";
        if ($conn->query($sql_eliminar) === TRUE) {
            echo "<script>alert('Producto eliminado exitosamente.');</script>";
        } else {
            echo "Error al eliminar el producto: " . $conn->error;
        }
    }
}
?>
