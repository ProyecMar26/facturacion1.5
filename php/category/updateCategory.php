<?php

require "../../php/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ids = $_POST['id_categoria'];
    $categorias = $_POST['categoria'];

    // Actualizar cada categoría en la base de datos
    foreach ($ids as $index => $id) {
        $categoria = $conn->real_escape_string($categorias[$index]);
        $sql_update_categoria = "UPDATE categoria SET categoria='$categoria' WHERE id_categoria='$id'";

        if (!$conn->query($sql_update_categoria)) {
            echo "Error actualizando la categoría: " . $conn->error;
        }
    }

    $conn->close();
    header("Location: ../../modules/category.php");
    exit();
}

?>
